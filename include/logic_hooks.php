<?php 
global $globalLogicHook;
$globalLogicHook['before_save'] = array();
$globalLogicHook['after_save'] = array();
$globalLogicHook['before_save'][] = array("beforesave","include/hooks/hook.php","SystemLogicHook","beforeSave");
$globalLogicHook['after_save'][] = array("aftersave","include/hooks/hook.php","SystemLogicHook","afterSave");
$globalLogicHook['after_save'][] = array("aftersave","include/hooks/hook.php","SystemLogicHook","workflowAfterSave");


?>