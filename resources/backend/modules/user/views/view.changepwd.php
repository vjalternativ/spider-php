<?php

class userViewChangePwd extends BackendResourceView {
    function display() {
     $this->tpl= 'modules/user/tpls/changepwd.tpl';
     parent::display();
    }
}
?>