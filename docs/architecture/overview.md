# Architecture overview

spider-php is a front-controller MVC framework. A small entry script selects a resource
(backend, frontend, REST or CLI); `lib_framework` then resolves a module and action,
invokes the matching resource controller, and renders a view or template.

## Layers

| Layer | Responsibility | Source |
| --- | --- | --- |
| Entry points | Select framework mode and start the dispatcher. | `index.php`, `rest.php`, `Spider*Framework.php` |
| Dispatcher | Resolve resource, module, action and session; run the controller. | `libs/lib_framework.php` |
| Bootstrap/common | Load configuration and shared initialisation. | `libs/lib_common.php`, `libs/lib_config.php` |
| Resource controllers | Base classes shared by every module of a resource type. | `resources/ResourceController.php`, `resources/backend/`, `resources/frontend/`, `resources/rest/`, `resources/cli/`, `resources/widget/` |
| Modules | Per-feature controllers, models and views. | `resources/*/modules/` |
| Rendering | Smarty integration, templates and view helpers. | `libs/lib_smarty.php`, `include/templates/`, `include/tpls/`, `libs/html/` |
| Persistence | Database abstraction and drivers. | `libs/lib_database.php`, `libs/lib_mysqli.php`, `libs/lib_postgres.php` |
| Runtime beans | JSON-backed runtime state (modules, temporary files). | `beans/` |
| Shared libraries | Sessions, SEO, CSV/XML, pagination, logging, timezone, etc. | `libs/` |
| Services and utilities | REST plumbing, cURL wrapper, locks, modals. | `service/`, `util/` |
| Hooks | Extension points loaded during bootstrap. | `include/hooks/hook.php` |
| Installer data | Schema and data patches applied by the CLI installer. | `include/install/` |

## Request in one sentence

The entry script starts `lib_framework`; `init()` chooses the resource and loads
configuration, `execute()` picks the module/action, instantiates
`<module><Resource>Controller`, calls `action_<action>()` and renders the result. The
detailed sequence is in [Request lifecycle](request-lifecycle.md).

## Configuration and state

Configuration is global and array-based (`config.php`), exposed through the
`lib_config` singleton (`libs/lib_config.php`). Runtime state that must survive between
requests is written as JSON by `beans/RuntimeBean.php` and its subclasses.

TODO: document the hook contract in `include/hooks/hook.php` and how applications
register hooks.
