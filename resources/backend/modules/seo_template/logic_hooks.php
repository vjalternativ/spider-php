<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['seo_template']['before_save'] = array();
$logicHook['seo_template']['before_save'][] = array(
    "beforesave",
    "resources/backend/modules/seo_template/SEOTemplateLogicHook.php",
    "SEOTemplateLogicHook",
    "beforeSave"
);
lib_datawrapper::getInstance()->set("logichook_list", $logicHook);
