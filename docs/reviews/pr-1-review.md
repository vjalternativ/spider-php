# Review: PR #1 — MathJax CDN fix, sitemap deleted filter

- **Pull request:** <https://github.com/vjalternativ/spider-php/pull/1>
- **Head:** `21459e04fc6a9c781af581a6b198271abade9880` (`refs/pull/1/head`)
- **Merge ref:** `ba62bdfe2bf811c08c8dbcea0dd702dcd880ebe7` (`refs/pull/1/merge`)
- **Merge base:** `dca841c46fcf229f274625a9339cd434f136d00d`
- **Net diff:** 3 files changed, 4 insertions(+), 4 deletions(−)
- **Verdict:** **Approve with follow-ups. No blocking issues.**

## How this was reviewed

```bash
git fetch origin 'refs/pull/1/head:refs/remotes/origin/pr/1'
git log --oneline origin/master..origin/pr/1
git diff origin/master...origin/pr/1
```

Commits in the PR:

| Commit | Subject | Net effect |
| --- | --- | --- |
| `a2a784b1` | Fix MathJax rendering on Mac | `header.tpl`, `ckeditor/config.js` |
| `eec8003c` | Exclude deleted records from sitemap | `SiteMapProcessor.php` |
| `16dc5b7c` | Support declared table keys in schema repair | reverted below — net zero |
| `21459e04` | Revert "Support declared table keys in schema repair" | net zero |

## Blocking issues

None. Both functional changes are correct and consistent with the existing
codebase; the review below records follow-ups and pre-existing problems the PR
touches but does not introduce.

## Findings (non-blocking)

### F1 — Sitemap filter only prevents *new* inclusions; stale `<url>` entries remain

`resources/cli/modules/sitemap/SiteMapProcessor.php:95`

The job is incremental: pages already written are stamped with the job token
(`:170-171`) and skipped on later passes (`:95`, `sitemap != '<token>'`), while
`createXML()` (`:217`) only runs for a brand-new file and `updateXml()` appends.
A page soft-deleted *after* it was written therefore stays in the generated
`sitemap-N.xml` until the file is deleted and regenerated from scratch.

The added `deleted=0` is still a correct improvement (deleted pages no longer
enter a sitemap being built), but it does not remove existing URLs. Follow-up:
on soft-delete, either invalidate the module's sitemap file/`sitemap` row or
strip the matching `<url>` node during regeneration.

### F2 — `deleted=0` assumes the column exists on every page module table

`resources/cli/modules/sitemap/SiteMapProcessor.php:95`

Framework-created tables always include it: `deleted` is in
`lib_entity::$defaultFields` (`libs/lib_entity.php:206-220`) and soft deletes set
`deleted=1` (`libs/lib_entity.php:822`). Schema repair covers older tables. A
manually created page table without the column would now make the whole job fail
with `Unknown column 'deleted'` instead of skipping rows. Low risk for this
repository, worth a note in the sitemap module docs or a defensive check against
`tableinfo.fields`.

### F3 — No automated coverage

The repository has no test suite or `composer.json` scripts, so this PR ships
with none — acceptable here, but the two fixes are only manually verifiable.
Suggested manual checks are listed at the end of this document.

### Nits

- **N1 — History noise.** `16dc5b7c` + `21459e04` are an add-and-immediate-revert
  pair with a net-zero diff. Squash or rebase before merge so the merge history
  does not carry a dead change. (Confirmed complete: `git diff origin/master
  origin/pr/1 -- libs/lib_entity.php resources/backend/modules/adminarea/SchemaDataPatcher.php`
  is empty.)
- **N2 — Vendored file edited in place.** `thirdparty/client/ckeditor/config.js:10`
  lives under `thirdparty/` and will be overwritten by a CKEditor upgrade. An
  application-level config override, or a note in the upgrade procedure about
  this local patch, would be more durable.
- **N3 — Pre-existing: string-concatenated SQL.** `$module` and
  `$this->job['token']` are interpolated directly
  (`SiteMapProcessor.php:51`, `:95`, `:170`). Values come from `tableinfo` /
  the job row rather than request input, so this is not a new injection path,
  but `lib_database` escaping/bound parameters should be used when the file is
  next touched.
- **N4 — Pre-existing: debug output.** `echo $sql` / `echo "going to process
  xml..."` (`SiteMapProcessor.php:98`, `:112`) write query text and internals to
  CLI logs; prefer a logger or remove before production use.
- **N5 — Pre-existing: XML escaping.** `DOMDocument::createElement($name, $value)`
  does not escape the value (`SiteMapProcessor.php:193`), so an alias containing
  `&` or `<` produces malformed XML. Use `createTextNode()`/`appendChild()`.
- **N6 — Trailing newline fix** in `SiteMapProcessor.php` is harmless housekeeping.

## File-by-file notes

### `resources/backend/include/tpls/header.tpl:27`

```diff
-  src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
+  src="https://cdn.jsdelivr.net/npm/mathjax@2.7.9/MathJax.js?config=TeX-AMS-MML_SVG">
```

- **Correctness:** `cdn.mathjax.org` was retired in 2017; the old URL returns
  404, so backend pages had no MathJax at all. The replacement is a live,
  version-pinned npm distribution. `TeX-AMS-MML_SVG` is a valid MathJax 2.7
  combined config; the npm package ships `config/` and `jax/`, which MathJax
  resolves relative to `MathJax.js`, so `?config=` works from the jsDelivr path.
- **Surfaces checked:** this is the only MathJax reference in application code
  (`grep -rn mathjax resources include config.php seoconfig.php`); there is no
  frontend template loading MathJax, so no other page surface needs the change.
- **Security/consistency:** moves from a floating `latest` tag to a pinned
  version over HTTPS — an availability and supply-chain improvement. No SRI
  attribute is practical for the MathJax 2 loader because it pulls subresources
  dynamically; if a CSP is added, `cdn.jsdelivr.net` must be allowed.

### `thirdparty/client/ckeditor/config.js:10`

```diff
-config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
+config.mathJaxLib = 'https://cdn.jsdelivr.net/npm/mathjax@2.7.9/MathJax.js?config=TeX-AMS-MML_SVG';
```

- **Correctness:** the editor now loads the same MathJax build/config as the
  backend page, removing version drift between the editor iframe
  (`plugins/mathjax/plugin.js:139`, `:349`) and the host page.
- The plugin passes the value through `CKEDITOR.getUrl()`, which leaves absolute
  `https://` URLs unchanged; switching from protocol-relative to explicit HTTPS
  is safe. The plugin's own documented default
  (`plugins/mathjax/plugin.js:450`) is only an example, not a requirement.
- See N2 for the vendored-file concern.

### `resources/cli/modules/sitemap/SiteMapProcessor.php:95`

```diff
-... where   alias is not null  and (sitemap is null or sitemap != '<token>')
+... where deleted=0 and alias is not null and (sitemap is null or sitemap != '<token>')
```

- **Correctness:** matches the framework-wide soft-delete convention —
  `beans/ModuleRuntime.php:31`, `libs/lib_entity.php:947`, `:960`,
  `resources/cli/modules/sitemap/sitemapCliController.php:11`, `:109`.
- **Edge cases:** `alias is not null` is complemented by the existing
  `trim()` + `empty()` guard at `:139-142`, so empty aliases are already
  skipped; no additional filter is needed. Soft-deleted rows are now excluded
  before the token stamp, so they are never added going forward (see F1 for
  already-written entries).
- **Other sitemap queries checked:** the `sitemap` table lookup at `:52` and
  the token stamp at `:170` operate on framework-managed rows; the job list and
  module list queries already filter `deleted=0`. `getPageSql()` was the only
  page-listing query missing the filter.
- **Auth:** the CLI sitemap module has no user-facing endpoint; no auth
  surface changes.

## Test coverage

No test infrastructure exists (`tests/` absent, no `composer.json` scripts), and
`php` is not installed in the review shell, so the PR could not be executed. The
changes were reviewed statically against the framework's conventions. Manual
verification to run before merge:

1. Open any backend page with math content: MathJax loads from jsDelivr and
   typesets (no 404 for `cdn.mathjax.org` in the network tab).
2. Open a CKEditor instance with the MathJax plugin: the math dialog preview
   renders (both TeX and MathML input).
3. Soft-delete a page (`deleted=1`) and run the sitemap CLI job for its module
   with a fresh job/token: the deleted page must not appear in the generated
   `sitemap-N.xml`.
4. Regression check: a normal page is still included exactly once.

## Acceptance of the review itself

```bash
$ git -C /home/claude/workspace/spider-php status
On branch master
Your branch is up to date with 'origin/master'.

$ git -C /home/claude/workspace/spider-php diff origin/master...origin/pr/1 --stat
 resources/backend/include/tpls/header.tpl          | 2 +-
 resources/cli/modules/sitemap/SiteMapProcessor.php | 4 ++--
 thirdparty/client/ckeditor/config.js               | 2 +-
 3 files changed, 4 insertions(+), 4 deletions(-)
```

Both commands exit 0 from the agent shell; the workspace bootstrap needed for
this is documented in
[Installation → Agent workspace / git access](../getting-started/installation.md#agent-workspace--git-access).
