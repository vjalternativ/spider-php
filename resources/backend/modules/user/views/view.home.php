<?php
class userViewHome extends View {
	function display() {
		$vjconfig = lib_config::getInstance()->getConfig();
		global $current_user;
		$bs = lib_bootstrap::getInstance()->getVars();
		$this->tpl = $vjconfig['fwbasepath'].'modules/user/tpls/home.tpl';
		$this->params = array('bs'=>$bs,'msg'=>"Welcome ".$current_user->user_type);
		parent::display();

	}
}
?>