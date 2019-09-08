<?php 
global $cronconfig;
ini_set("memory_limit",-1);
set_time_limit(0);

require_once 'cronconfig.php';
require_once 'include/vjlib/interface/CronJob.php';

global $vjlib,$vjconfig,$seoParams;
set_include_path(__DIR__);

$path = __DIR__;
$lockfile = $path.'/locks/cronthread.lock';
$lockfilehandle = fopen ( $lockfile, 'w' );
if ($lockfilehandle === false) {
    exit ( "Unable to create/open lock file\n" );
}

if (! flock ( $lockfilehandle, LOCK_EX | LOCK_NB )) {
    exit ( "Lock already in use by another process\n" );
}

echo "Lock file acquired -> Running\n";


$path = __DIR__;
if(isset($cronconfig[$path])) {
    $_SERVER['HTTP_HOST'] = $cronconfig[$path]['host'];
    $_REQUEST['entryPoint'] = "cronprocess";
    require_once 'config.php';
    require_once 'extraconfig.php';
    require_once 'seoconfig.php';
    require_once 'seomanager.php';
    
    date_default_timezone_set($vjconfig['timezone']);
    require_once 'include/vjlib/VJLib.php';
    require_once 'include/Smarty/Smarty.class.php';
    
    $vjlib = new VJLib();
    $vjlib->loadlibs(array("Entity","BootStrap","MysqliLib","Logger"));
    
    
    $vjlib->getobj("VJFramework");
    
}

echo "Lock file released -> Done\n";
fclose ( $lockfilehandle );


?>