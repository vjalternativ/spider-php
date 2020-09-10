<?php
class adminareaViewHome extends BackendResourceView {
	function display() {
	    $vjconfig = lib_config::getInstance()->getConfig();
	    $this->tpl = $vjconfig['fwbasepath'].'resources/backend/modules/adminarea/tpls/home.tpl';
		parent::display();
	}
}
?>