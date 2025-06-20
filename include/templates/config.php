<?php
global $config;
$config = array();

$config['sitename'] = "Spider-PHP Control Panel";
$config['timezone'] = "Asia/Kolkata";

$config['server_timezone'] = "Asia/Kolkata";

$config['database']['host'] = "localhost";

$config['database']['user'] = "__DBUSER__";

$config['database']['password'] = "__DBPASSWORD__";

$config['database']['name'] = "__DBNAME__";

$config['framework']['default_module'] = "user";
$config['framework']['default_action'] = "login";

$config['framework']['after_login_module'] = "user";
$config['framework']['after_login_action'] = "home";

$config['framework']['seourl'] = false;
$config['defaultlang'] = 'en_us';

$config['adminemail'][] = "vj.alternativ@gmail.com";

$config['sitetpl'] = "v1";

$config['display_errors'] = false;

$config['resources'] = array(
    "backend",
    "frontend",
    "cli"
);
$config['default_resource'] = "frontend";
$config['default_resource_module']['backend'] = "user";
$config['default_resource_action']['backend'] = "login";
$config['default_resource_module']['frontend'] = "page";
$config['default_resource_action']['frontend'] = "index";
$config['resource_alias']['backend'] = 'controlarea';

$config['disabledb'] = __DISABLEDBVALUE__;

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $config['database']['user'] = "__DBUSER__";
    $config['database']['password'] = "__DBPASSWORD__";
    $config['database']['name'] = "__DBNAME__";
    $config['display_errors'] = true;
}