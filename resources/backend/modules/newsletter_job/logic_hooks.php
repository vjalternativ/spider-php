<?php
$logicHook = lib_datawrapper::getInstance()->get("logichook_list");
$logicHook['newsletter_job']['before_save'] = array();
$logicHook['newsletter_job']['after_save'] = array();
//$logicHook['newsletter_job']['before_save'][] = array("beforesave","custom/modules/vendor_user/hooks/hook.php","LogicHook","beforeSave");
$logicHook['newsletter_job']['after_save'][] = array("aftersave","resources/backend/modules/newsletter_job/hooks/hook.php","LogicHook","afterSave");
lib_datawrapper::getInstance()->set("logichook_list",$logicHook);
?>