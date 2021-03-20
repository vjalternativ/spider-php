<?php
global $config;
$config = array();

$config['baseurl'] = 'https://boomerangtrip.com/';
$config['fwbaseurl'] = $config['baseurl'] . 'spider-php/';

$config['sitename'] = "Spider-PHP Control Panel";
$config['timezone'] = "Asia/Kolkata";

$config['mysql']['host'] = "localhost";

$config['mysql']['user'] = "boomerangdemo";

$config['mysql']['password'] = "boomerangtrip";

$config['mysql']['database'] = "boomerangtripdemo";

$config['framework']['default_module'] = "user";
$config['framework']['default_action'] = "login";

$config['framework']['default_mode'] = "entryPoint";
$config['framework']['default_entrypoint'] = "site";

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

if ($_SERVER['HTTP_HOST'] == "localhost") {

    $config['baseurl'] = 'http://localhost/spider-php/';
    $config['fwbaseurl'] = $config['baseurl'] . 'spider-php';

    $config['mysql']['user'] = "root";
    $config['mysql']['password'] = "root";
    $config['mysql']['database'] = "spiderphp";
    $config['display_errors'] = false;
}