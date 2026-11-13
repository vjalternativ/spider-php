# Services and utilities

Small helper layers used by the framework and by application code.

## REST services

| File | Class | Purpose |
| --- | --- | --- |
| `service/rest/restController.php` | `restController` | Base REST controller. |
| `service/rest/api/IRest.php` | `IRest` (interface) | REST endpoint contract. |
| `service/rest/api/ARest.php` | `ARest` (abstract) | Shared REST endpoint implementation. |
| `service/rest/api/user/userRest.php` | `userRest` | Example user endpoint built on `ARest`. |

The REST entry point (`rest.php` → `SpiderRestFramework`) selects the `rest` resource,
whose controller is `resources/rest/RestResourceController.php`.

## HTTP

| File | Class | Purpose |
| --- | --- | --- |
| `service/curl.php` | `CurlRequest` | cURL request wrapper (method, parameters, URL). |

## Utilities

| File | Class | Purpose |
| --- | --- | --- |
| `util/file/LockUtil.php` | `LockUtil` | File-based locking; used by the cron frameworks (`locks/`). |
| `util/ui/ModalUtil.php` | `ModalUtil` | Modal dialog rendering helper. |

## Widget layer

| File | Class/interface | Purpose |
| --- | --- | --- |
| `resources/widget/IWidgetService.php` | `IWidgetService` | Widget service contract. |
| `resources/widget/WidgetService.php` | `WidgetService` | Widget lookup and loading. |
| `resources/widget/WidgetServiceRegistrar.php` | `WidgetServiceRegistrar` | Static accessor: `getWidgetServiceInstance()`. |
| `resources/widget/AWidget.php` | `AWidget` (abstract) | Widget base class. |
| `resources/widget/WidgetResourceController.php` | `WidgetResourceController` | Resource controller for widget rendering. |

Widget implementations live in `resources/widget/modules/<widget>/`. See
[How to use a widget in a page](../guides/how-to-use-widget-in-page.md).

TODO: document `ARest` request/response conventions and `ModalUtil` options.
