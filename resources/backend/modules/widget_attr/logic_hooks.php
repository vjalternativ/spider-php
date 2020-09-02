<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");

$logicHook['widget_attr']['before_save'] = array();
$logicHook['widget_attr']['before_save'][] = array("aftersave","modules/widget_attr/hooks/widget_attrHook.php","widget_attrLogicHook","beforeSave");
lib_datawrapper::getInstance()->set("logichook_list",$logicHook);
