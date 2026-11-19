<?php
require_once __DIR__.'/authenticate/Authenticate.php';
class userBackendController extends BackendResourceController  {

	function __construct() {
		$this->nonauth['login'] = array("redirect"=>array("module"=>"user","action"=>"home"));
		$this->nonauth['authenticate'] = array();
		$this->nonauth['logout'] = array();
		$this->nonauth['home'] = array();
		parent::__construct();
	}

	function action_login() {
        $current_user = lib_current_user::getEntityInstance();
		if(!empty($current_user->id)) {
			lib_util::redirect('user','home');
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
		header('location:'.$vjconfig['urlbasepath'].$vjconfig['resource_alias']['backend']);
	}

	/**
	 * Resolve the user record a password change applies to.
	 *
	 * The header link passes "record"; the form posts "id". Fall back to the
	 * logged in user so the self-service change keeps working even if the
	 * request does not carry either parameter.
	 */
	function getPasswordRecordId() {
	    $record = '';
	    if (isset($_REQUEST['record']) && is_scalar($_REQUEST['record'])) {
	        $record = $_REQUEST['record'];
	    }
	    if ($record === '' && isset($_REQUEST['id']) && is_scalar($_REQUEST['id'])) {
	        $record = $_REQUEST['id'];
	    }
	    if ($record === '') {
	        $current_user = lib_current_user::getEntityInstance();
	        if ($current_user && !empty($current_user->id)) {
	            $record = $current_user->id;
	        }
	    }
	    return $record;
	}

	function passwordError($row, $msg) {
	    $this->params['changepwd'] = is_array($row) ? $row : array();
	    $this->params['error']['type'] = "danger";
	    $this->params['error']['msg'] = $msg;
	    $this->view = "changepwd";
	}

	function action_changePwd(){
	    $db = lib_database::getInstance();
	    $record = $this->getPasswordRecordId();
	    $row = array();
	    if ($record !== '') {
	        $sql="select * from user where id='".addslashes($record)."' and deleted=0";
	        $qry= $db->query($sql);
	        if ($qry) {
	            $row=$db->fetch($qry);
	        }
	    }
	    if (empty($row)) {
	        $row = array();
	        $this->params['error']['type'] = "danger";
	        $this->params['error']['msg'] = "User record not found.";
	    }
	    $this->params['changepwd']=$row;

	    $this->view="changepwd";

	}
	function action_getNewpwd() {
	    $db = lib_database::getInstance();

	    $id = $this->getPasswordRecordId();
	    $row = array();
	    if ($id !== '') {
	        $row = $db->getrow("select * from user where id='".addslashes($id)."' and deleted=0");
	    }
	    if (empty($row)) {
	        return $this->passwordError(array(), "User record not found.");
	    }

	    $newPassword = (isset($_REQUEST['user_hash_new']) && is_scalar($_REQUEST['user_hash_new'])) ? (string) $_REQUEST['user_hash_new'] : '';
	    $confirmPassword = (isset($_REQUEST['confirm_user_hash']) && is_scalar($_REQUEST['confirm_user_hash'])) ? (string) $_REQUEST['confirm_user_hash'] : '';
	    if ($newPassword === '') {
	        return $this->passwordError($row, "New password cannot be empty.");
	    }
	    if ($confirmPassword !== '' && $newPassword !== $confirmPassword) {
	        return $this->passwordError($row, "Password not matched.");
	    }

	    // Authenticate::login() compares md5($password) with user.user_hash,
	    // so the stored hash must be a single md5 of the new password.
	    $password=md5($newPassword);
	    $userId = $row['id'];
	    $sql="update user set user_hash='".$password."', date_modified='".date('Y-m-d H:i:s')."' where id='".addslashes($userId)."' and deleted=0";
	    $db->query($sql);

	    // The update query itself returns no affected-row count, so verify the
	    // stored hash instead of reporting success unconditionally.
	    $verify = $db->getrow("select user_hash from user where id='".addslashes($userId)."' and deleted=0");
	    if (empty($verify) || $verify['user_hash'] !== $password) {
	        return $this->passwordError($row, "Password could not be updated. Please try again.");
	    }

	    $this->params['changepwd'] = $row;
	    $this->params['success']['msg'] = "Password updated successfully.";
	    $this->view = "changepwd";
	}
}

?>