#!/usr/bin/env bash
#
# workspace-git-bootstrap.sh
#
# Make agent workspace checkouts usable for git inspection and PR review.
#
# Two failure modes are fixed here, both of which otherwise return after every
# container restart / workspace re-provisioning:
#
#   1. "fatal: detected dubious ownership in repository at '<path>'"
#      The checkout is owned by a different user than the one the agent shell
#      runs as. Preferred fix: chown the working tree to the current user.
#      Fallback (when chown is not permitted): register the path in the current
#      user's global git config as a safe.directory.
#
#   2. "unknown revision refs/pull/N/head"
#      The default clone refspec only maps refs/heads/*, so GitHub pull request
#      refs are never fetched. This script adds +refs/pull/*/head to
#      origin's fetch refspec (idempotently), so `git fetch origin` picks up
#      refs/remotes/origin/pr/* and PRs can be diffed/reviewed offline.
#
# The script is safe to run repeatedly: it skips already-correct ownership,
# never duplicates the fetch refspec or safe.directory entries, and never
# rewrites unrelated git configuration.
#
# Usage:
#   scripts/workspace-git-bootstrap.sh [--workspace <dir>] [--verify]
#
#   --workspace <dir>  Workspace root to process (default: /home/claude/workspace,
#                      or $WORKSPACE_ROOT when set). The root itself and each
#                      immediate subdirectory containing a .git entry are treated
#                      as repositories.
#   --verify           Also check that git can read each repository and that the
#                      origin remote exposes refs/pull/*/head (network check).
#                      Exits non-zero if any check fails.
#
# Environment:
#   WORKSPACE_ROOT   Default workspace root (overridden by --workspace).
#   WORKSPACE_OWNER  When running as root, the user that should own the
#                    checkouts (e.g. WORKSPACE_OWNER=claude). Without it the
#                    script does not chown and relies on safe.directory.
#
# Provisioning hook: run this script once per workspace prepare, as the agent
# shell user (or as root with WORKSPACE_OWNER set), after the checkout exists.

set -u

WORKSPACE_ROOT="${WORKSPACE_ROOT:-/home/claude/workspace}"
VERIFY=0

usage() {
    sed -n '3,50p' "$0" | sed 's/^# \{0,1\}//'
}

while [ $# -gt 0 ]; do
    case "$1" in
        --workspace)
            if [ $# -lt 2 ]; then
                echo "error: --workspace requires a directory argument" >&2
                exit 2
            fi
            WORKSPACE_ROOT="$2"
            shift 2
            ;;
        --workspace=*)
            WORKSPACE_ROOT="${1#--workspace=}"
            shift
            ;;
        --verify)
            VERIFY=1
            shift
            ;;
        -h|--help)
            usage
            exit 0
            ;;
        *)
            echo "error: unknown argument: $1" >&2
            usage >&2
            exit 2
            ;;
    esac
done

log() {
    printf '[workspace-git-bootstrap] %s\n' "$*"
}

warn() {
    printf '[workspace-git-bootstrap] WARN: %s\n' "$*" >&2
}

FETCH_REFSPEC='+refs/pull/*/head:refs/remotes/origin/pr/*'

# Resolve the uid/gid that should own the checkouts.
TARGET_UID="$(id -u)"
TARGET_GID="$(id -g)"
CAN_CHOWN=1

if [ "$TARGET_UID" -eq 0 ]; then
    if [ -n "${WORKSPACE_OWNER:-}" ] && id -u "$WORKSPACE_OWNER" >/dev/null 2>&1; then
        TARGET_UID="$(id -u "$WORKSPACE_OWNER")"
        TARGET_GID="$(id -g "$WORKSPACE_OWNER")"
    else
        # Running as root without an explicit owner: do not hand the tree to
        # root, fall back to safe.directory instead.
        CAN_CHOWN=0
        warn "running as root without WORKSPACE_OWNER; skipping chown and using safe.directory"
    fi
fi

# add_safe_directory <path>
# Idempotently append <path> to the global safe.directory list.
add_safe_directory() {
    local path="$1"
    if git config --global --get-all safe.directory 2>/dev/null | grep -Fxq -- "$path"; then
        log "safe.directory already present: $path"
        return 0
    fi
    if git config --global --add safe.directory "$path" 2>/dev/null; then
        log "registered safe.directory: $path"
        return 0
    fi
    warn "could not register safe.directory for $path (no writable global git config)"
    return 1
}

# ensure_ownership <path>
# Make <path> (recursively) owned by the target user, or fall back to
# safe.directory when that is not permitted.
ensure_ownership() {
    local path="$1"
    local current_owner

    current_owner="$(stat -c '%u:%g' "$path" 2>/dev/null || true)"
    if [ "$current_owner" = "$TARGET_UID:$TARGET_GID" ]; then
        log "ownership already correct: $path"
        return 0
    fi

    if [ "$CAN_CHOWN" -eq 1 ] && chown -R "$TARGET_UID:$TARGET_GID" "$path" 2>/dev/null; then
        log "chowned to $TARGET_UID:$TARGET_GID: $path"
        return 0
    fi

    # chown failed (or was skipped): git will still refuse the repo unless the
    # path is explicitly trusted.
    add_safe_directory "$path" || true
    return 0
}

# tune_remote <repo>
# Widen origin's fetch refspec so refs/pull/*/head lands in origin/pr/*.
tune_remote() {
    local repo="$1"

    if ! git -C "$repo" remote get-url origin >/dev/null 2>&1; then
        log "no origin remote, skipping refspec: $repo"
        return 0
    fi

    if git -C "$repo" config --get-all remote.origin.fetch 2>/dev/null | grep -Fxq -- "$FETCH_REFSPEC"; then
        log "pull-request refspec already configured: $repo"
        return 0
    fi

    if git -C "$repo" config --add remote.origin.fetch "$FETCH_REFSPEC" 2>/dev/null; then
        log "added pull-request refspec: $repo"
    else
        warn "could not add pull-request refspec: $repo"
    fi
}

# verify_repo <repo>
verify_repo() {
    local repo="$1"
    local failed=0

    if git -C "$repo" status --porcelain >/dev/null 2>&1; then
        log "verify: git status OK: $repo"
    else
        warn "verify: git status failed (ownership still untrusted?): $repo"
        failed=1
    fi

    # The refspec must be configured locally or `git fetch origin` will never
    # populate refs/remotes/origin/pr/*.
    if git -C "$repo" config --get-all remote.origin.fetch 2>/dev/null \
        | grep -qxF '+refs/pull/*/head:refs/remotes/origin/pr/*'; then
        log "verify: pull-request refspec configured: $repo"
    else
        warn "verify: pull-request refspec missing: $repo"
        failed=1
    fi

    # Reachability check. `ls-remote --exit-code <pattern>` exits 2 when the
    # remote is reachable but has no matching refs, so a repository with no open
    # pull requests is healthy — only an unreachable remote is a failure.
    local remote_output
    if remote_output=$(git -C "$repo" ls-remote origin 'refs/pull/*/head' 2>/dev/null); then
        if [ -n "$remote_output" ]; then
            local pr_count
            pr_count=$(printf '%s\n' "$remote_output" | wc -l | tr -d ' ')
            log "verify: origin exposes refs/pull/*/head ($pr_count ref(s)): $repo"
        else
            log "verify: origin reachable; no refs/pull/*/head matches (no open PRs): $repo"
        fi
    else
        warn "verify: cannot reach origin to list refs/pull/*/head: $repo"
        failed=1
    fi

    return "$failed"
}

bootstrap_repo() {
    local repo="$1"
    ensure_ownership "$repo"
    tune_remote "$repo"
}

if [ ! -d "$WORKSPACE_ROOT" ]; then
    warn "workspace root does not exist: $WORKSPACE_ROOT"
    exit 1
fi

log "workspace root: $WORKSPACE_ROOT (target owner $TARGET_UID:$TARGET_GID)"

REPOS_FOUND=0
FAILED=0

# The workspace root may itself be the checkout.
if [ -e "$WORKSPACE_ROOT/.git" ]; then
    REPOS_FOUND=$((REPOS_FOUND + 1))
    bootstrap_repo "$WORKSPACE_ROOT"
    if [ "$VERIFY" -eq 1 ]; then
        verify_repo "$WORKSPACE_ROOT" || FAILED=1
    fi
fi

# Plus every immediate child checkout (the usual layout).
for candidate in "$WORKSPACE_ROOT"/*; do
    [ -d "$candidate" ] || continue
    [ -e "$candidate/.git" ] || continue
    [ "$candidate" = "$WORKSPACE_ROOT" ] && continue
    REPOS_FOUND=$((REPOS_FOUND + 1))
    bootstrap_repo "$candidate"
    if [ "$VERIFY" -eq 1 ]; then
        verify_repo "$candidate" || FAILED=1
    fi
done

if [ "$REPOS_FOUND" -eq 0 ]; then
    warn "no git checkouts found under $WORKSPACE_ROOT"
    exit 1
fi

log "processed $REPOS_FOUND checkout(s)"

if [ "$VERIFY" -eq 1 ] && [ "$FAILED" -ne 0 ]; then
    warn "one or more verification checks failed"
    exit 1
fi

exit 0
