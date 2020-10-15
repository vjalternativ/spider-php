<?php

require_once lib_config::getInstance()->get("fwbasepath").'resources/backend/modules/notification/notificationService.php';

class chatroomBackendController extends BackendResourceController{
    function action_index() {
        notificationService::getInstance()->registerNotificationPath("backend","workbench","workbench/".session_id());
        parent::action_index();
    }
}
?>