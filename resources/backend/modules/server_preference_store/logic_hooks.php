<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['server_preference_store']['after_save'] = array();
$logicHook['server_preference_store']['after_save'][] = array("aftersave","resources/backend/modules/server_preference_store/hooks/server_preference_storeLogicHook.php","server_preference_storeLogicHook","afterSave");
lib_datawrapper::getInstance()->set("logichook_list",$logicHook);
