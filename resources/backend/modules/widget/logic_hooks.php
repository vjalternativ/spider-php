<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['widget']['before_save'] = array();
$logicHook['widget']['before_save'][] = array(
    "aftersave",
    "resources/backend/modules/widget/hooks/widgetLogicHook.php",
    "widgetLogicHook",
    "beforeSave"
);
lib_datawrapper::getInstance()->set("logichook_list", $logicHook);
