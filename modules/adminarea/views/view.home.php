<?php
class adminViewHome extends View {
	function display() {
		$this->tpl = 'modules/admin/tpls/home.tpl';
		parent::display();
	}
}
?>