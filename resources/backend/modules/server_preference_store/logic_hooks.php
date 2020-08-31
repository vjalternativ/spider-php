<?php 
global $logicHook;
$logicHook['server_preference_store']['after_save'] = array();
$logicHook['server_preference_store']['after_save'][] = array("aftersave","modules/server_preference_store/hooks/server_preference_storeLogicHook.php","server_preference_storeLogicHook","afterSave");
