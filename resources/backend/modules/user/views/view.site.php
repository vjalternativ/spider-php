<?php
class userViewSite extends BackendResourceView {
	function display() {

		$vjconfig = lib_config::getInstance()->getConfig();
		$bs = lib_bootstrap::getInstance()->getVars();
		$path = $vjconfig['basepath'];
		$path .= 'resources/backend/modules/user/tpls/login.tpl';
		$error = '';
		if(!empty($this->params['error'])) {
		$error = $this->params['error'];
		}
		parent::display($path,array('bs'=>$bs,'error'=>$error));

	}
}
?>