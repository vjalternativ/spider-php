<?php
global $vjconfig;
$vjconfig = array();

$vjconfig['baseurl'] = 'https://boomerangtrip.com/';
$vjconfig['fwbaseurl'] = $vjconfig['baseurl'] .'controlarea/';

$vjconfig['sitename'] = "Exam-N-Review Control Panel";
$vjconfig['timezone'] = "Asia/Kolkata";

$vjconfig['mysql']['host'] = "localhost";

$vjconfig['mysql']['user'] = "boomerangdemo";

$vjconfig['mysql']['password'] = "boomerangtrip";

$vjconfig['mysql']['database'] = "boomerangtripdemo";


$vjconfig['framework']['default_module'] = "user";
$vjconfig['framework']['default_action'] = "login";

$vjconfig['framework']['default_mode'] = "entryPoint";
$vjconfig['framework']['default_entrypoint'] = "site";

$vjconfig['framework']['after_login_module'] = "user";
$vjconfig['framework']['after_login_action'] = "home";

$vjconfig['framework']['seourl'] = false;
$vjconfig['defaultlang'] = 'en_us';


$vjconfig['adminemail'][] = "vj.alternativ@gmail.com";

$vjconfig['sitetpl'] = "enr";



if($_SERVER['HTTP_HOST']=="localhost") {
    
    $vjconfig['baseurl'] = 'http://localhost/examnreview/';
    $vjconfig['fwbaseurl'] = $vjconfig['baseurl'] .'controlarea/';
    
    $vjconfig['mysql']['user'] = "root";
    $vjconfig['mysql']['password'] = "root";
    $vjconfig['mysql']['database'] = "examprod";
    $vjconfig['display_errors'] = true;
    
}