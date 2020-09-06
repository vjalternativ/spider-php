<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");

$logicHook['tableinfo_language_m_m']['before_save'] = array();
$logicHook['tableinfo_language_m_m']['after_save'] = array();
$logicHook['tableinfo_language_m_m']['after_save'][] = array("aftersave","modules/tableinfo_language_m_m/hooks/hook.php","tableinfo_language_m_mLogicHook","afterSave");
lib_datawrapper::getInstance()->set("logichook_list",$logicHook);
?>