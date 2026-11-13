# First application

This page describes the minimum wiring between a web server and the framework. It
summarises the two installation methods in [Installation](installation.md) and points at
the real source files involved.

## 1. Choose an entry point

A spider-php application is reached through a thin PHP entry script.

| Entry script | Framework class | Mode |
| --- | --- | --- |
| `index.php` | `SpiderBackendFramework` | `BACKEND` |
| `rest.php` | `SpiderRestFramework` | `REST` |

Both classes extend `lib_framework` and only set `$_REQUEST['spiderphp_mode']` before
calling `parent::__construct($sessionName)` and `execute()`.

The Composer installation described in [Installation](installation.md) instead creates an
`index.php` that instantiates `lib_framework` directly:

```php
<?php
set_time_limit(0);
ini_set("memory_limit", -1);
set_include_path(__DIR__);
require_once 'vendor/autoload.php';
require_once 'vendor/vizzy/spider-php/libs/lib_framework.php';
$fw = new lib_framework(__DIR__);
$fw->execute();
```

See [Entry points](../architecture/entry-points.md) for the full list of framework
classes, including the cron and CLI wrappers.

## 2. Configure the application

Framework behaviour is driven by `config.php` in the project root:

- `baseurl` / `fwbaseurl` — public URLs of the application and framework assets.
- `database` — host, user, password and database name.
- `resources` — which resource types are enabled (`backend`, `frontend`, `cli`).
- `default_resource`, `default_resource_module`, `default_resource_action` — fallback
  module/action per resource.
- `resource_alias` — URL aliases such as `controlarea` for `backend`.

See [Configuration reference](../reference/configuration.md) for every config file.

## 3. Install the schema

The CLI installer seeds the default schema, menus, roles and other data patches:

```bash
cd <your-project-path>
php index.php spider install
```

Data patches live in `include/install/datapatch/` and schema patches in
`include/install/schemapatch/`.

## 4. Log in

After installation, the backend is reachable through the default backend module, for
example `index.php?module=user&action=login`. Once logged in, configure menus as described
in [Backend menu configuration](../guides/backend-menu-configuration.md).

TODO: document environment-specific overrides (the `localhost` block in `config.php` is
currently the only example).
