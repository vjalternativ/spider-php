<?php
class userViewLogin extends BackendResourceView {
	function display() {

		$vjconfig = lib_config::getInstance()->getConfig();
		$this->tpl = $vjconfig['fwbasepath'].'resources/backend/modules/user/tpls/login.tpl';
		$error = '';
		if(!empty($this->params['error'])) {
		$error = $this->params['error'];
		}
		$this->params = array('error'=>$error);
		parent::display();

	}
}


?>