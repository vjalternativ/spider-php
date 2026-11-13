# Configuration reference

All framework configuration is plain PHP that populates global arrays.

## `config.php`

The main web configuration. Keys observed in the file:

| Key | Meaning |
| --- | --- |
| `baseurl` | Public URL of the application. |
| `fwbaseurl` | Public URL where the framework's `resources/` and `libs/` assets are served. |
| `sitename` | Display name of the control panel. |
| `timezone` | PHP default timezone. |
| `database.host` / `user` / `password` / `name` | Database connection. |
| `framework.default_module` / `default_action` | Fallback module and action. |
| `framework.default_mode` / `default_entrypoint` | Default framework mode and entry point. |
| `framework.after_login_module` / `after_login_action` | Redirect target after login. |
| `framework.seourl` | Enable SEO-style URLs. |
| `defaultlang` | Default language code. |
| `adminemail` | Administrator email address(es). |
| `sitetpl` | Active site template (for example `v1`). |
| `display_errors` | PHP error display. |
| `resources` | Enabled resource types. |
| `default_resource` | Resource used when the URL does not name one. |
| `default_resource_module` / `default_resource_action` | Per-resource module/action defaults. |
| `resource_alias` | URL alias to resource mapping (for example `controlarea` → `backend`). |

The shipped file also contains a `localhost` override block that switches the base URL and
database credentials.

## `cliconfig.php`

Maps a project path to the host used for CLI runs:

```php
$cliconfig['/var/www/html/spider-php']['host'] = "localhost";
```

`SpiderCronFramework` reads this array before dispatching a cron run.

## `cronconfig.php`

Maps deployed project paths to the host each cron job should emulate. Used by the cron
entry points when running from a shared codebase.

## `extraconfig.php`

Per-project overrides loaded after the main configuration. The shipped file is a
placeholder showing how to branch on session/request values.

## `seoconfig.php`

SEO route definitions. Each top-level key is a URL segment with `params` (module,
action, entry point, page) and optional `child` routes:

```php
$seoConfig['example']['params']['module'] = "examplemodule";
$seoConfig['example2']['child']['example3']['params']['method'] = "examplemethod";
```

`lib_seo::getParams()` consumes this structure during dispatch.

## `admindb.php`

A large standalone admin/database utility script bundled at the repository root. It is not
part of the dispatcher and is intended for direct administrative use.

## Where these are read

- `libs/lib_common.php` — loads configuration during bootstrap.
- `libs/lib_config.php` — singleton accessor (`getInstance()->get(...)`).
- `libs/lib_framework.php` — resource defaults, aliases, session name and dispatch.
- `libs/lib_seo.php` — SEO parameters and URL aliasing.

TODO: document the complete key set, including keys added by application overrides.
