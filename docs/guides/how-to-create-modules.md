# How to create modules

A module is a feature folder under a resource's `modules/` directory.

| Resource | Module root |
| --- | --- |
| Backend | `resources/backend/modules/` |
| Frontend | `resources/frontend/modules/` |
| Widgets | `resources/widget/modules/` |
| CLI / cron | `resources/cli/modules/` |
| REST | `resources/rest/modules/` |

## How a module is resolved

`libs/lib_framework.php` (`execute()`) builds the controller class name as
`<module><Resource>Controller` — for example module `page`, resource `backend` becomes
`pageBackendController`, loaded from `resources/backend/modules/page/`. The action is the
method `action_<action>`, with `action_index` as the fallback.

Views are resolved from `resources/<resource>/modules/<module>/views/` using
`<module>View<View>.php` or `view.<view>.php`.

## Existing examples

- `resources/backend/modules/page/` — backend page module.
- `resources/widget/modules/` — widget implementations such as `card`, `table`, `modal`.
- `resources/cli/modules/` — CLI modules such as `cron`, `mail`, `sitemap`, `spider`.

Follow [Coding standards](../reference/codingstandards.md) when adding a module.

TODO: add a step-by-step walkthrough (controller skeleton, view, menu entry and
permissions) once a reference module is chosen.
