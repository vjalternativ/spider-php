<?php 
global $logicHook;
$logicHook['media_files']['before_save'] = array();
$logicHook['media_files']['before_save'][] = array("beforesave","modules/media_files/hooks/media_filesLogicHook.php","media_filesLogicHook","beforeSave");
