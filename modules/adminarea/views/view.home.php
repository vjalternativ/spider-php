<?php
class adminareaViewHome extends View {
	function display() {
	    $vjconfig;
	    $this->tpl = $vjconfig['fwbasepath'].'modules/adminarea/tpls/home.tpl';
		parent::display();
	}
}
?>