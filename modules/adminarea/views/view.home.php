<?php
class adminareaViewHome extends View {
	function display() {
		$this->tpl = $this->vjconfig['fwbasepath'].'modules/adminarea/tpls/home.tpl';
		parent::display();
	}
}
?>