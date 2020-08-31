<?php 
global $logicHook;
$logicHook['widget']['before_save'] = array();
$logicHook['widget']['before_save'][] = array("aftersave","modules/widget/hooks/widgetHook.php","widgetLogicHook","beforeSave");
