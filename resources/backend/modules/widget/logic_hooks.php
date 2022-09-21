<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['widget']['before_save'] = array();
$logicHook['widget']['before_save'][] = array(
    "beforeSave",
    "resources/backend/modules/widget/hooks/widgetLogicHook.php",
    "widgetLogicHook",
    "beforeSave"
);

$logicHook['widget']['after_save'] = array();
$logicHook['widget']['after_save'][] = array(
    "afterSave",
    "resources/backend/modules/widget/hooks/widgetLogicHook.php",
    "widgetLogicHook",
    "afterSave"
);
lib_datawrapper::getInstance()->set("logichook_list", $logicHook);
