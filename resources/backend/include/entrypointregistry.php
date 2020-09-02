<?php
$entrypoints = lib_datawrapper::getInstance()->get("entrypoints_list");
if(!$entrypoints) {
    $entrypoints = array();
}
$vjconfig = lib_config::getInstance()->getConfig();
$entrypoints['install'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/install.php",'auth'=>false);
$entrypoints['patch'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/patch.php",'auth'=>false);
$entrypoints['site'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/site/index.php",'auth'=>false,'type'=>'siteEntryPoint');
$entrypoints['test'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/test/test.php",'auth'=>false);
$entrypoints['sendMail'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/sendMail.php",'auth'=>false);
$entrypoints['cron'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/cron.php",'auth'=>false);
$entrypoints['cronprocess'] = array("path"=>$vjconfig['fwbasepath']."include/entrypoints/cronprocess.php",'auth'=>false);

?>