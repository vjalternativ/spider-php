<?php
class chatroomViewList extends ViewList {


    function preDisplay() {
        parent::preDisplay();
        $currentUser = lib_current_user::getEntityInstance();
        if(($currentUser && (isset($currentUser->privileges['agent.live.chat']) || $currentUser->user_type=="developer"))) {
            $this->additionalContent = '<a  href="./index.php?module=chatroom" type="text" class="btn btn-success pull-right margin-right-10">Reload</a>';
            $this->additionalActions = '<a target="_blank" href="./index.php?module=chat&action=join&room_id=RID" type="text" class="btn btn-success">Join</a>';
        }
    }
    function afterDisplay() {
        $currentUser = lib_current_user::getEntityInstance();
        if(($currentUser && (isset($currentUser->privileges['agent.live.chat']) || $currentUser->user_type=="developer"))) {

            echo '<script src="'.lib_config::getInstance()->get("fwbaseurl").'resources/backend/modules/chatroom/assets/js/chatroom.js"></script>';
        }
    }
}
?>