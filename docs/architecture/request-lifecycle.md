# Request lifecycle

The sequence below is what `libs/lib_framework.php` actually does for a web request or a
CLI invocation. Line references are to that file.

## 1. Entry script

A web request reaches `index.php` (backend) or `rest.php` (REST). Both instantiate a
`Spider*Framework` class and call `execute()`. CLI runs through `SpiderCronFramework`,
`SpiderCronThreadFramework` or `SpiderToolFramework`.

## 2. Framework construction

`lib_framework::__construct()`:

1. Derives the project path from `$_SERVER['SCRIPT_FILENAME']` (the directory of the
   running script).
2. Sets that directory as the PHP include path and stores it as `configpath`.
3. Calls `init()`.

## 3. Initialisation (`init()`)

1. `lib_common::init($configpath)` loads the configuration and shared bootstrap.
2. Configuration is read through the `lib_config` singleton.
3. `lib_seo::getParams()` turns the request into SEO/URL path parameters.
4. The resource is chosen in this order:
   - `cli` and the module from `$_SERVER['argv']` when running under the CLI SAPI;
   - the first SEO path parameter when it matches `resource_alias` or `resources` in
     `config.php`;
   - `$_GET['resource']` when present;
   - otherwise `default_resource` from `config.php`.
5. The resource base path is resolved under `resources/<resource>/`.
6. `spiderphp_mode` (set by the entry class) is stored as the framework mode.
7. A session name is derived (`fw_sess_mode`, an explicit session name, or
   `<session>_<resource>`), then `initSession()` starts the session.

## 4. Dispatch (`execute()`)

1. If `module` is not set, it is taken from the SEO parameters or from
   `default_resource_module`, with `default_resource_action` as the action fallback.
   Missing actions default to `index`.
2. The base classes are loaded: `resources/ResourceController.php`,
   `resources/widget/WidgetResourceController.php`, and
   `resources/<resource>/<Resource>ResourceController.php`.
3. The module controller class name is `<module><Resource>Controller` (for example
   `pageBackendController`), resolved from `resources/<resource>/modules/<module>/`. If no
   module controller is found, the resource controller itself is used.
4. The action method is `action_<action>`; if it does not exist, `action_index` is used.
5. The controller action runs. It populates `$controller->params` (shared with views and
   templates) and optionally sets `$controller->view`.

## 5. Rendering

When the controller sets a view:

1. `lib_smarty::getSmartyInstance()` is prepared with `fwbaseurl`, `fwbasepath` and
   `urlscheme`, and `params` is assigned to the template.
2. `resources/<resource>/include/views/<Resource>ResourceView.php` and an optional
   `...ResourceViewExten.php` are loaded.
3. The view class is resolved in this order:
   `<module>View<View>Exten`, `<module>View<View>`,
   `resources/<resource>/modules/<module>/views/view.<view>.php`, then the backend
   fallback `resources/backend/modules/<module>/views/view.<view>.php`.
4. The view runs `preHeader()`, `_loadHeader()`, `preDisplay()`, `display()`,
   `afterDisplay()` and `_loadFooter()`.

## 6. Response

Whatever the view and template emit is the response. There is no separate response object
in the core dispatcher.

## See also

- [Entry points](entry-points.md)
- [Directory layout](directory-layout.md)
- [Libraries reference](../reference/libs.md) (`lib_entity`, `lib_smarty`, `lib_util`)
