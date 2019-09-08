<?php 
$logicHook['tableinfo']['before_save'] = array();
$logicHook['tableinfo']['after_save'] = array();
$logicHook['tableinfo']['after_save'][] = array("aftersave","modules/tableinfo/hooks/hook.php","tableinfoLogicHook","afterSave");

?>