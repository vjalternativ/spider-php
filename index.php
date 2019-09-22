<?php
require_once 'framework.php';
$fw = new SpiderPhpFramework();
$fw->setconfigPath(__DIR__.'/../');
$fw->execute(true);
?>