<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['tableinfo']['before_save'] = array();
$logicHook['tableinfo']['after_save'] = array();
$logicHook['tableinfo']['after_save'][] = array("aftersave","modules/tableinfo/hooks/hook.php","tableinfoLogicHook","afterSave");
lib_datawrapper::getInstance()->set("logichook_list",$logicHook);
?>