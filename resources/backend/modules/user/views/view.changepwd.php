<?php

class userViewChangePwd extends BackendResourceView {
    function display() {
     $this->tpl= 'resources/backend/modules/user/tpls/changepwd.tpl';
     parent::display();
    }
}
?>