<?php
class adminareaViewRoles extends View {
	function display() {
	    global $vjconfig;
	    $path = $vjconfig['fwbasepath'].'modules/adminarea/tpls/roles.tpl';
		parent::display($path);
	}
}
?>