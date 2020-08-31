<?php
class adminareaViewRoles extends View {
	function display() {
	    $vjconfig = lib_config::getInstance()->getConfig();
	    $path = $vjconfig['fwbasepath'].'modules/adminarea/tpls/roles.tpl';
		parent::display($path);
	}
}
?>