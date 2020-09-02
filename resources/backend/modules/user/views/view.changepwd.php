<?php

class userViewChangePwd extends View {
    function display() {
        $vjconfig = lib_config::getInstance()->getConfig();

     $this->tpl= 'modules/user/tpls/changepwd.tpl';
   // echo $html;
   //$this->assign("changepwd",$this->params['changepwd']);
     parent::display();
    }
}
?>