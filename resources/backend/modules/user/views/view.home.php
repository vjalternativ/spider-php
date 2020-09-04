<?php
class userViewHome extends BackendResourceView {
	function display() {
		$vjconfig = lib_config::getInstance()->getConfig();
		$current_user = lib_current_user::getEntityInstance();
		$bs = lib_bootstrap::getInstance()->getVars();
		$this->tpl = $vjconfig['fwbasepath'].'modules/user/tpls/home.tpl';
		$this->params = array('bs'=>$bs,'msg'=>"Welcome ".$current_user->user_type);
		parent::display();

	}
}
?>