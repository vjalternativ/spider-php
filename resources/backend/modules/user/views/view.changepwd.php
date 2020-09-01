<?php

class userViewChangePwd extends View {
    function display() {
        global $vjconfig;
     $this->tpl= 'modules/user/tpls/changepwd.tpl';
   // echo $html;
   //$this->assign("changepwd",$this->params['changepwd']);
     parent::display();
    }
}
?>