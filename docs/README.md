# spider-php documentation

Hierarchical index for the spider-php framework. Start with
[Getting started](getting-started/index.md), then use the sections below to drill in.

## Sections

| Section | What it covers |
| --- | --- |
| [Getting started](getting-started/index.md) | Install the framework and wire a first application. |
| [Architecture](architecture/index.md) | Entry points, request lifecycle and directory layout. |
| [Guides](guides/index.md) | Task recipes: modules, pages, widgets, menus, headers and footers. |
| [Reference](reference/index.md) | Library classes, beans, services/utilities and configuration. |
| [Assignments](assignments/index.md) | Practice exercises that exercise the framework end to end. |

## Feature inventory

| Feature | Documentation | Source |
| --- | --- | --- |
| Backend MVC / control panel | [Request lifecycle](architecture/request-lifecycle.md), [Modules guide](guides/how-to-create-modules.md) | `resources/backend/`, `resources/ResourceController.php` |
| Frontend pages / homepage | [Homepage creation](guides/frontend-homepage-creation.md) | `resources/frontend/` |
| Header and footer templates | [Header and footer](guides/frontend-header-footer.md) | `resources/frontend/include/` |
| REST API | [Entry points](architecture/entry-points.md) | `rest.php`, `SpiderRestFramework.php`, `resources/rest/`, `service/rest/` |
| Cron jobs | [Entry points](architecture/entry-points.md) | `SpiderCronFramework.php`, `SpiderCronThreadFramework.php`, `resources/cli/modules/cron/` |
| CLI and installer | [Entry points](architecture/entry-points.md), [Installation](getting-started/installation.md) | `libs/lib_cli.php`, `resources/cli/`, `SpiderToolFramework.php` |
| Database abstraction | [Libraries](reference/libs.md) | `libs/lib_database.php`, `libs/lib_mysqli.php`, `libs/lib_postgres.php` |
| Templates (Smarty) | [Libraries](reference/libs.md) | `libs/lib_smarty.php`, `include/templates/`, `include/tpls/` |
| Widgets | [Widget guide](guides/how-to-use-widget-in-page.md) | `resources/widget/` |
| Backend modules | [Modules guide](guides/how-to-create-modules.md) | `resources/backend/modules/` |
| Menu configuration | [Menu guide](guides/backend-menu-configuration.md) | `include/install/datapatch/menu*.json`, `resources/backend/modules/` |
| SEO | [Configuration](reference/configuration.md) | `libs/lib_seo.php`, `seoconfig.php`, `seomanager.php` |
| Reports | [Libraries](reference/libs.md) | `libs/htmlreport/`, `libs/html/` |
| Installer / data patches | [Installation](getting-started/installation.md) | `include/install/` |
| Configuration | [Configuration reference](reference/configuration.md) | `config.php`, `cliconfig.php`, `cronconfig.php`, `extraconfig.php`, `admindb.php` |
| Hooks | [Architecture overview](architecture/overview.md) | `include/hooks/hook.php` |
| Runtime beans | [Beans reference](reference/beans.md) | `beans/` |

## Conventions

- All paths are relative to the repository root.
- `TODO:` marks a known documentation gap, not a missing feature.
- Existing prose pages were kept verbatim when they were moved into this hierarchy.
