<?php
class userViewHome extends View {
	function display() {
		global $vjlib,$vjconfig,$current_user;
		$bs = $vjlib->BootStrap->vars;
		$path = $vjconfig['basepath'];
		$this->tpl = 'modules/user/tpls/home.tpl';
		$this->params = array('bs'=>$bs,'msg'=>"Welcome ".$current_user->user_type);
		parent::display();
		
	}
}
?>