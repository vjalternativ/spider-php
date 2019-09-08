<?php 
class userViewLogin extends View {
	function display() {
		
		global $vjlib,$vjconfig;
		$bs = $vjlib->BootStrap->vars;
		$path = $vjconfig['basepath'];
		$this->tpl = 'modules/user/tpls/login.tpl';
		$error = '';
		if(!empty($this->params['error'])) {
		$error = $this->params['error'];
		}
		$this->params = array('bs'=>$bs,'error'=>$error);
		parent::display();
		
	}
}


?>