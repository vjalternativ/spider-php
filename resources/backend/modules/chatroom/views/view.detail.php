<?php
class chatroomViewDetail extends ViewDetail {

    function preDisplay() {
       parent::preDisplay();
       $currentUser = lib_current_user::getEntityInstance();
       if(($currentUser && (isset($currentUser->privileges['agent.live.chat']) || $currentUser->user_type=="developer"))) {
           $this->additionalContent = '<a target="_blank" href="./index.php?module=chat&action=join&room_id='.$this->data['id'].'" type="text" class="btn btn-success pull-right margin-right-10">Join</a>';
       }
    }
}
?>