<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook = $logicHook ? $logicHook : array();
$logicHook['sitemapjob'] = array();
$logicHook['sitemapjob']['before_save'] = array();
$logicHook['sitemapjob']['before_save'][] = array(
    "beforesave",
    "resources/backend/modules/sitemapjob/SitemapJobLogicHook.php",
    "SitemapJobLogicHook",
    "beforeSave"
);
lib_datawrapper::getInstance()->set("logichook_list", $logicHook);
