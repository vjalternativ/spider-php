<?php

class userViewChangePwd extends BackendResourceView {
    function display() {
     // displayTpl()/loadTpl() only assign the merged params under $params,
     // so expose the values changepwd.tpl reads at the top level.
     $smarty = lib_smarty::getSmartyInstance();
     $smarty->assign('changepwd', isset($this->params['changepwd']) ? $this->params['changepwd'] : array());
     $smarty->assign('error', isset($this->params['error']) ? $this->params['error'] : false);
     $smarty->assign('success', isset($this->params['success']) ? $this->params['success'] : false);
     $this->displayTpl("changepwd.tpl");
    }
}
?>