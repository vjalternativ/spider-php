<?php 

$logicHook['page']['before_save'] = array();
$logicHook['page']['after_save'] = array();
$logicHook['page']['before_save'][] = array("beforesave","include/hooks/aliashook.php","AliasLogicHook","beforeSave");

?>