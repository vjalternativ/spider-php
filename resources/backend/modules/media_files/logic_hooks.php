<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['media_files']['before_save'] = array();
$logicHook['media_files']['before_save'][] = array(
    "beforesave",
    "resources/backend/modules/media_files/hooks/media_filesLogicHook.php",
    "media_filesLogicHook",
    "beforeSave"
);
lib_datawrapper::getInstance()->set("logichook_list", $logicHook);
