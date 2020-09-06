<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");

$logicHook['page']['before_save'] = array();
$logicHook['page']['after_save'] = array();
$logicHook['page']['before_save'][] = array("beforesave","include/hooks/aliashook.php","AliasLogicHook","beforeSave");
lib_datawrapper::getInstance()->set("logichook_list",$logicHook);
?>