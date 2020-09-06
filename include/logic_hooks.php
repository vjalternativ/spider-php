<?php
$globalLogicHook = lib_datawrapper::getInstance()->get("global_logichook_list");
$globalLogicHook['before_save'] = array();
$globalLogicHook['after_save'] = array();
$globalLogicHook['before_save'][] = array("beforesave","include/hooks/hook.php","SystemLogicHook","beforeSave");
$globalLogicHook['after_save'][] = array("aftersave","include/hooks/hook.php","SystemLogicHook","afterSave");
$globalLogicHook['after_save'][] = array("aftersave","include/hooks/hook.php","SystemLogicHook","workflowAfterSave");
lib_datawrapper::getInstance()->set("global_logichook_list", $globalLogicHook);

?>