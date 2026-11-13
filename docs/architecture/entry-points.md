# Entry points

The repository exposes five thin framework roots. Each one sets a mode and delegates to
the dispatcher in `libs/lib_framework.php`.

| File | Class | Mode | Used for | Notes |
| --- | --- | --- | --- | --- |
| `index.php` | `SpiderBackendFramework` (`SpiderBackendFramework.php`) | `BACKEND` | Web control panel | Requires `framework.php` from the application root. |
| `rest.php` | `SpiderRestFramework` (`SpiderRestFramework.php`) | `REST` | JSON/REST endpoints | Resource controllers live in `resources/rest/` and `service/rest/`. |
| `SpiderCronFramework.php` | `SpiderCronFramework` | `CRON` | Scheduled jobs | Takes a project path, loads `cliconfig.php`, uses the `cli` resource and the `cron` module, and serialises runs with `locks/cronlock.lock`. |
| `SpiderCronThreadFramework.php` | `SpiderCronThreadFramework` | `CRON` | Concurrent cron workers | Same as above with per-thread locking; see the file for the lock name. |
| `SpiderToolFramework.php` | `SpiderToolFramework` | `TOOL`/CLI | Developer and installer commands | Implements the tool commands used by `php index.php spider ...`. |
| `libs/lib_framework.php` | `lib_framework` | (inherited) | Base dispatcher | The Composer installation instantiates it directly. |

## Config companions

| File | Purpose |
| --- | --- |
| `config.php` | Web configuration: URLs, database, resources, defaults. |
| `cliconfig.php` | Maps a project path to the host used for CLI/cron runs. |
| `cronconfig.php` | Maps deployed project paths to cron hosts. |
| `extraconfig.php` | Additional per-project overrides. |
| `seoconfig.php` | SEO settings. |
| `admindb.php` | Bundled admin/database utility page. |

See [Configuration reference](../reference/configuration.md) for the keys inside each
file.

## Invoking the CLI

```bash
# installer
php index.php spider install

# cron worker
php SpiderCronFramework.php /path/to/project
```

`lib_framework::init()` maps `$_SERVER['argv'][1]` to the module and
`$_SERVER['argv'][2]` to the action when the CLI SAPI is active.

TODO: document each `SpiderToolFramework` command and each module under
`resources/cli/modules/`.
