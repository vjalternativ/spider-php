<?php
global $entrypoints;
$entrypoints['install'] = array("path"=>"include/entrypoints/install.php",'auth'=>false);
$entrypoints['patch'] = array("path"=>"include/entrypoints/patch.php",'auth'=>false);
$entrypoints['site'] = array("path"=>"include/entrypoints/site/index.php",'auth'=>false,'type'=>'siteEntryPoint');
$entrypoints['boomerangvacations'] = array("path"=>"include/entrypoints/boomerangvacations/index.php",'auth'=>false,'type'=>'siteEntryPoint');
$entrypoints['flightwikipedia'] = array("path"=>"include/entrypoints/flightwikipedia/index.php",'auth'=>false,'type'=>'siteEntryPoint');
$entrypoints['test'] = array("path"=>"include/entrypoints/test/test.php",'auth'=>false);
$entrypoints['sendMail'] = array("path"=>"include/entrypoints/sendMail.php",'auth'=>false);
$entrypoints['papajourney'] = array("path"=>"include/entrypoints/papajourney/index.php",'auth'=>false,'type'=>'siteEntryPoint');
$entrypoints['cron'] = array("path"=>"include/entrypoints/cron.php",'auth'=>false);
$entrypoints['cronprocess'] = array("path"=>"include/entrypoints/cronprocess.php",'auth'=>false);

?>