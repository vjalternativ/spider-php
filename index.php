<?php
session_name('ATVPHPSESSID');
ini_set('session.gc_maxlifetime', 28800);
session_set_cookie_params(28800);
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
ini_set("memory_limit",-1);
set_time_limit(0);
ini_set("display_errors",1);
error_reporting(E_ALL);
//error_reporting(0);
global $vjlib,$vjconfig,$seoParams;
set_include_path(__DIR__);

require_once 'config.php';
require_once 'extraconfig.php';
require_once 'seoconfig.php';
require_once 'seomanager.php';

date_default_timezone_set($vjconfig['timezone']);
require_once 'include/vjlib/VJLib.php';
require_once 'include/Smarty/Smarty.class.php';

$vjlib = new VJLib();
$vjlib->loadlibs(array("Entity","BootStrap","MysqliLib","Paginate","Logger"));
$vjlib->getobj("VJFramework");

?>