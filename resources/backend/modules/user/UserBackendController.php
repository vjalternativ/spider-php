<?php
require_once __DIR__.'/authenticate/Authenticate.php';
class UserBackendController extends BackendResourceController  {

	function __construct() {
		$this->nonauth['login'] = array("redirect"=>array("module"=>"user","action"=>"home"));
		$this->nonauth['authenticate'] = array();
		$this->nonauth['logout'] = array();
		$this->nonauth['home'] = array();
		parent::__construct();
	}

	function action_login() {

		global $current_user;
		if(!empty($current_user->id)) {
			redirect('user','cpanel');
		}
		$this->view = 'login';
	}

	function action_home() {
	    $this->view = 'home';
	}


	function action_index() {
	   $this->setIgnoreRecords( array("user_type"=>array("developer")));
	    parent::action_index();
	}


	function action_authenticate() {
		$this->params['error']['type'] = "danger";
		$this->params['error']['msg'] = "Username or password is Incorrect correct";
		if(!empty($_POST['username']) && !empty($_POST['password'])) {
			$authenticate = new Authenticate();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$isLogin = $authenticate->login($username,$password);
			if($isLogin) {
			   $this->view = 'home';
		    } else {
			    $this->view = 'login';
			}
		} else {
		    $this->view = 'login';
		}


	}


	function action_logout() {
		$vjconfig = lib_config::getInstance()->getConfig();
		session_destroy();
		header('location:'.$vjconfig['fwurlbasepath']);
	}

	function action_changePwd(){
	    global $db;
	    $record= $_REQUEST['record'];
	    $sql="select * from user where id='".$record."'and deleted=0";
	    $qry= $db->query($sql);
	    $row=$db->fetch($qry);
	    $this->params['changepwd']=$row;

	    $this->view="changepwd";

	}
	function action_getNewpwd() {
	    global $db;

	    $id=$_REQUEST['id'];
	    $password=md5($_REQUEST['user_hash_new']);
	    $sql="update user set user_hash='". $password."' where id='".$id."' and deleted=0";
	    //die($sql);
	    $db->query($sql);
	    $this->action_home();
	}
}

?>