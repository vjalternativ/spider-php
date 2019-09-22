<?php 
global $logicHook;
$logicHook['widget_attr']['before_save'] = array();
$logicHook['widget_attr']['before_save'][] = array("aftersave","modules/widget_attr/hooks/widget_attrHook.php","widget_attrLogicHook","beforeSave");
