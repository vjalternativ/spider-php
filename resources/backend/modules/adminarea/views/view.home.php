<?php
class adminareaViewHome extends View {
	function display() {
	    $vjconfig = lib_config::getInstance()->getConfig();
	    $this->tpl = $vjconfig['fwbasepath'].'modules/adminarea/tpls/home.tpl';
		parent::display();
	}
}
?>