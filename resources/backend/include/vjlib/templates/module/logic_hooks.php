<?php 

$logicHook['__MODULENAME__']['before_save'] = array();
$logicHook['__MODULENAME__']['after_save'] = array();
$logicHook['__MODULENAME__']['before_save'][] = array("beforesave","custom/modules/__MODULENAME__/hooks/__MODULENAME__LogicHook.php","__MODULENAME__LogicHook","beforeSave");
$logicHook['__MODULENAME__']['after_save'][] = array("aftersave","custom/modules/__MODULENAME__/hooks/logic_hooks.php","__MODULENAME__LogicHook","afterSave");

?>