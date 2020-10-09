<?php
class chatroomViewDetail extends ViewDetail {

    function preDisplay() {
       parent::preDisplay();
       $this->additionalContent = '<a href="./index.php?module=chat&action=join&room_id='.$this->data['id'].'" type="text" class="btn btn-success pull-right margin-right-10">Join</a>';
    }
}
?>