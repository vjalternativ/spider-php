# Directory layout

```
spider-php/
├── index.php                     backend entry point
├── rest.php                      REST entry point
├── Spider*Framework.php          cron, threaded-cron, tool and web framework roots
├── config.php                    web configuration
├── cliconfig.php                 CLI/cron project-to-host map
├── cronconfig.php                deployed cron hosts
├── extraconfig.php               per-project overrides
├── seoconfig.php                 SEO configuration
├── seomanager.php                SEO helper script
├── admindb.php                   bundled admin/database utility
├── composer.json                 Composer package definition
├── beans/                        JSON-backed runtime state objects
├── docs/                         this documentation
├── include/                      shared views, templates, hooks and installer patches
├── libs/                         framework libraries (DB, Smarty, SEO, CLI, reports, ...)
├── locks/                        cron lock files
├── resources/                    resource types, controllers and modules
│   ├── ResourceController.php
│   ├── backend/                  control panel: controller, assets, views, modules
│   ├── frontend/                 public site controller and views
│   ├── rest/                     REST resource controller
│   ├── cli/                      CLI resource, commands and cron modules
│   └── widget/                   widget service, registrar and widget modules
├── service/                      REST API plumbing and cURL wrapper
├── thirdparty/                   vendored front-end libraries
└── util/                         file/UI utilities (locks, modals)
```

## Where things live

| You want to change... | Go to |
| --- | --- |
| Backend screens | `resources/backend/modules/<module>/` |
| Public pages | `resources/frontend/` and `resources/frontend/modules/` |
| Widgets | `resources/widget/modules/<widget>/` |
| Cron jobs | `resources/cli/modules/cron/` (and sibling modules) |
| Shared templates | `include/templates/`, `include/tpls/`, `include/views/` |
| Default menus, roles, forms | `include/install/datapatch/`, `include/install/schemapatch/` |
| Framework behaviour | `libs/` |
| Requests and dispatch | `libs/lib_framework.php` |
| Configuration | `config.php` and the other root config files |

## Notes

- `resources/frontend/` contains the frontend controller and `include/views/`. Site
  templates such as `tpls/v1/header.tpl` referenced by the guides are copied into the
  host project during installation (see
  [Installation](../getting-started/installation.md)).
- `thirdparty/` is vendored code. Do not document or modify it as part of the framework.
- The web entry wrappers (`SpiderBackendFramework.php`, `SpiderRestFramework.php`) load
  `framework.php` from the project root. That loader is provided by an installed
  application rather than tracked in this standalone repository; the Composer entry point
  in [Installation](../getting-started/installation.md) loads
  `libs/lib_framework.php` directly instead.
