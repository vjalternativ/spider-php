# Installation

## Method - 1 - Use spider-php as composer package

### create a new php project in eclipse
* click on file
* click on new
* click on php project
* enter project name
* click on finish

### add composer support in your newly created project
* right click on project
* click on configure
* click on add composer support
* set type as project
* save composer file
* click on install dependency on top right corner
* click on dependencies tab
* search spider-php in packgist
* select vizzy/spider-php package
* click on add dependency
* save dependency
* select vizzy/spider-php and click on update


### index.php configuration

* put below code in index.php

	<?php
	set_time_limit(0);
	ini_set("memory_limit", - 1);
	set_include_path(__DIR__);
	require_once 'vendor/autoload.php';
	require_once 'vendor/vizzy/spider-php/libs/lib_framework.php';
	$fw = new lib_framework(__DIR__);
	$fw->execute();
	?>




## Method 2 - Use spider-php as symbolic link

###import the spider-php project into eclipse workspace

####or git clone spider-php from github

git clone https://github.com/vjalternativ/spider-php.git
 
 

### create a php project in eclipse 

### either copy the spider-php folder into your project 

### or symbolic link (shortcut link) the spider-php into your project

cd <your-project-folder>
ln -s /var/www/html/spider-php .

### copy all the files and folders from spider-php/include/templates into your project


### copy .htaccess files to which would not show in eclipse project explorer. eiher you can get the .htaccess file in spider-php/include/docs/templates/.htaccess or also you can use shortcut command ctrl+shift+f and search .htaccess file.

### configure db, urlbasepath in config.php for localhost in your project

### configure basepath in cliconfig.php in localhost your project


### install default database schema by running the command

cd <yourprojectpath>

php index.php spider install


## now you can login into backend with below credentials

url <baseurl>/backend
username : vjalternativ
password : workst@48


## Agent workspace / git access

Automated agents inspect this checkout with plain `git`, which fails unless the
checkout is trusted by the shell user. Two problems otherwise come back after
every container restart or workspace re-provisioning:

1. **Dubious ownership** — `fatal: detected dubious ownership in repository at
   '<path>'`. The working tree is owned by a user other than the one running the
   shell.
2. **Pull request refs are missing** — a default clone only maps
   `+refs/heads/*:refs/remotes/origin/*`, so `refs/pull/N/head` is never fetched
   and PRs cannot be diffed locally (or reviewed when the shell has no ad-hoc
   GitHub access).

Run the bootstrap script once per workspace prepare, as the agent shell user
(or as root with `WORKSPACE_OWNER` set):

```bash
scripts/workspace-git-bootstrap.sh --workspace /home/claude/workspace --verify
```

What it does, idempotently:

- Makes the checkout owned by the current user (`chown -R`). When chown is not
  permitted it falls back to `git config --global --add safe.directory <path>`,
  which persists in the shell user's global git config across restarts.
- Adds `+refs/pull/*/head:refs/remotes/origin/pr/*` to `remote.origin.fetch`, so
  `git fetch origin` populates `origin/pr/<number>`.
- `--verify` also checks that `git status` works and that `origin` exposes
  `refs/pull/*/head`; it exits non-zero when a check fails.

The script must be invoked by the provisioning / workspace-prepare hook after
the checkout exists — running it by hand fixes only the current session.

Verify manually:

```bash
git -C /home/claude/workspace/spider-php status
git -C /home/claude/workspace/spider-php fetch origin 'refs/pull/1/head:refs/remotes/origin/pr/1'
git -C /home/claude/workspace/spider-php diff origin/master...origin/pr/1 --stat
```

All three must exit 0 and the last one must print a diffstat.







