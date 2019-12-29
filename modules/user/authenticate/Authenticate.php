<?php
class Authenticate {
	public $auth;
	function __construct($type='') {
		
		if(!empty($type))  {
		require_once 'modues/user/authenticate/'.$type.'.php';
		$this->auth = new $type;
		} else {
			$this->auth = $this;
		}
		
	}
	
	
	function processSession($row) {
	    global $current_user,$db,$globalModuleList;
	    $sql = "select r.id,r.name from  roles_user_1_m ru
                    INNER JOIN roles r on ru.roles_id = r.id and ru.deleted=0 and r.deleted=0 and ru.user_id = '".$row['id']."'
                    ";
	    $roles = $db->getrow($sql);
	    $row['role_id'] = false;
	    $row['role_name'] = false;
	    $row['module_access']  = false;
	    $row['isDeveloper'] = false;
	    if($row['user_type']=="developer") {
	        $row['isDeveloper'] = true;
	    }
	    if($roles) {
	        $row['role_id'] = $roles['id'];
	        $row['role_name'] = $roles['name'];
	        $sql = "select ri.*,t.id as module_id,t.name as module_name from tableinfo t
                        left join roles_item ri on t.id=ri.module_id and role_id='".$roles['id']."' ";
	        $row['module_access'] =  $db->fetchRows($sql,array("module_id"));
	        $sql = "select p.name from roles_privilege_1_m rp
                            INNER JOIN privilege p on rp.privilege_id=p.id and p.deleted=0 and rp.roles_id ='".$roles['id']."' and  rp.deleted=0  ";
	        $row['privileges'] =  $db->fetchRows($sql,array("name"),"name");
	        
	        /* if(isset($globalModuleList[$row['role_name']])) {
	            $sql= "select * from ".$row['role_name']." where deleted=0 and ownership_id='".$row['id']."' ";  
	            $row['role_data'] = $db->getrow($sql);
	        } */
	    }
	    
	    $current_user = $this->setsession("current_user", $row);
	    
	}
	
	function login($username,$password) {
		global $db;
		$password = md5($password);
		$sql = "SELECT * FROM user WHERE user_name ='".$username."' AND user_hash ='".$password."' and deleted=0";
		
		$qry = $db->query($sql);
		if($qry->num_rows == 0) {
			return false;
		} else {
		    $row = $db->fetch($qry);
		    $this->processSession($row);    
		}
		
		return true;
	}
	
	function setsession($var,$array) {
		$obj = new Entity();
		foreach($array as $key=>$val) {
			$obj->$key = $val;
		}
		$_SESSION[$var] = json_encode($array);

		return $obj;
	}
}