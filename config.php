<?php
global $config;
$config = array();

$config['baseurl'] = 'https://boomerangtrip.com/';
$config['fwbaseurl'] = $config['baseurl'] .'controlarea/';

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

$config['sitetpl'] = "enr";

$config['display_errors'] = false;

if($_SERVER['HTTP_HOST']=="localhost") {

    $config['baseurl'] = 'http://localhost/spider-php/';
    $config['fwbaseurl'] = $config['baseurl'] . 'controlarea' ;

    $config['mysql']['user'] = "root";
    $config['mysql']['password'] = "root";
    $config['mysql']['database'] = "spiderphp";
    $config['display_errors'] = true;

}