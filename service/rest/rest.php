<?php 
ini_set("display_errors",1);

require_once __DIR__.'/../../framework.php';

$_REQUEST['spiderphp_mode'] = 'rest';
$fw = new SpiderPhpFramework();
$fw->execute(true);
?>