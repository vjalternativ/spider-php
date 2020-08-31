<?php
class userViewSite extends View {
	function display() {

		global $vjconfig;
		$bs = lib_bootstrap::getInstance()->getVars();
		$path = $vjconfig['basepath'];
		$path .= 'modules/user/tpls/login.tpl';
		$error = '';
		if(!empty($this->params['error'])) {
		$error = $this->params['error'];
		}
		parent::display($path,array('bs'=>$bs,'error'=>$error));

	}
}
?>