<?php
class adminareaViewRoles extends View {
	function display() {
	    $path = $this->vjconfig['fwbasepath'].'modules/adminarea/tpls/roles.tpl';
		parent::display($path);
	}
}
?>