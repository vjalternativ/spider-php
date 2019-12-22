<?php
class View {
	public $params = array();
	public $listview = array();
	public $tpls = array();
	public $module = '';
	public $record = '';
	public $entity =false;
	public $data = false;
	public $tableinfo = array();
	public $tpl;
	public $isLoggedIn = false;
	public $showChatContainer = false;
	function preDisplay() {
	    
	}
	
	function display() {
	       
	    global $entity,$smarty;
		$entity->module = $this->module;
		
		
		
		if($this->record) {
		    
			$this->data = $entity->get($this->module,$this->record);
		}
		
		
		
		foreach($this->params as $key=>$val) {
			$smarty->assign($key,$val);
		}
		
		
		echo $smarty->fetch($this->tpl);
	}
	
	function afterDisplay() {
	}

	
	function getAllMenu() {
	    global $db,$current_user;
	    
	    if(!$current_user) {
	        return array();
	    }
	    
	    $sql = "select m.name as menu,t.label as module,m.id as menu_id,t.id as tableinfo_id,t.* from menu_tableinfo_1_m mt 
                INNER JOIN menu m on mt.menu_id=m.id and m.deleted=0
                INNER JOIN tableinfo t on mt.tableinfo_id = t.id and t.deleted=0 ";
        
	    if(!$current_user->isDeveloper) {
	        if(!$current_user->role_id) {
	            return array();
	        }
	        $sql .= "INNER JOIN roles_item ri on t.id = ri.module_id and ri.role_id ='".$current_user->role_id."'";   
	    }
	    
        $sql .=" WHERE mt.deleted=0";
	    
	    
	    
	    $qry =  $db->query($sql);
	    $rows = array();
	    while($row = $db->fetch($qry)) {
	        $rows[$row['menu_id']]['menu'] = $row['menu'];
	        $rows[$row['menu_id']]['items'][$row['tableinfo_id']] = $row;
	    }
	    return $rows;
	}
	
	function loadHeader() {
		global $vjlib,$current_user,$vjconfig,$smarty;
		$bs = $vjlib->BootStrap;
		$bs->vars['cssList']['bootstrap']= '<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].$bs->vars['path'].'bootstrap/css/bootstrap.min.css" />';
		$bs->vars['cssList']['custom']= '<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].$bs->vars['path'].'css/custom.css" />';
		
		
		//$bs->vars['jsList']['jquery']= '<script  href="'.$bs->vars['path'].'js/jquery-3.1.1.min.js" ><script>';
		
		$logout = false;
		$adminarea = false;
		$href = "index.php?module=user&action=logout";
		$href = processUrl($href);
		if(!empty($current_user->id)) {
			$logout = getelement('a','Logout',array('class'=>array('value'=>'btn btn-info pull-right'),'href'=>array('value' => $href)));
			if($current_user->user_type == 'developer') {
			    $href = processUrl("index.php?module=adminarea&action=home");

			    $adminarea = getelement('a','Administrator',array('class'=>array('value'=>'btn btn-success margin-right-10 pull-right'),'href'=>array('value' => $href)));
			}
		}
		
	
		   $this->isLoggedIn = $logout;
		
			$smarty->assign("bs",$bs->vars);
			$smarty->assign("logout",$logout);
			$smarty->assign("adminarea",$adminarea);
			$smarty->assign("vjconfig",$vjconfig);
			$path = $vjconfig['fwbasepath'];
				
			$smarty->assign("baseurl",$vjconfig['baseurl']);
			echo "<script> var baseurl ='".$vjconfig['baseurl']."' </script>";
			echo "<script> var fwbaseurl ='".$vjconfig['fwbaseurl']."' </script>";
			
			$menudata = $this->getAllMenu();
			$smarty->assign("menudata",$menudata);
			$smarty->assign("current_user",$current_user);
			
			echo $smarty->fetch('include/vjlib/libs/tpls/header.tpl');
		
		
		
		
	
	}
	function loadFooter() {
		global $vjconfig,$current_user;
		$path = $vjconfig['fwbasepath'];
		$smarty = new Smarty();
		$smarty->assign("logout",$this->isLoggedIn);
		if($this->isLoggedIn && isset($current_user->privileges['agent.live.chat'])) {
		  $this->showChatContainer = true;  
		}
		$smarty->assign("showchatContainer",$this->showChatContainer);
		
		$smarty->assign("relatemodal",$path."include/vjlib/libs/tpls/relatemodal.tpl");
		echo $smarty->fetch('include/vjlib/libs/tpls/footer.tpl');
		
	}
	
	
	function show($path) {
	    global $smarty;
	    foreach($this->params as $key=>$val) {
	        $smarty->assign($key,$val);
	    }
	    echo $smarty->fetch($path);
	}
	
	function loadTpl($tpl,$params=array()) {
	    global $smarty,$vjconfig;
	    
	    $module = $this->module;
	    
	   // $smarty->assign('bootparams',$this->bootparams);
	    $this->params += $params;
	    $smarty->assign('params',$this->params);
	    
	    $path = $vjconfig['basepath'].'custom/modules/'.$module.'/tpls/'.$tpl;
	    $content = "";
	    if(file_exists($path)) {
	        $content =  $smarty->fetch($path);
	    }
	    
	    return $content;
	    
	}
	
	function processDefForLang($suffix,$vardef,$deftype="editview") {
	    global $globalModuleList,$entity;
	    $langTable = $this->module."_".$suffix;
	    
	    
	    if(isset($globalModuleList[$langTable]) && strlen($this->data['id'])==36) {
	        
	        
	        $langData  = $entity->get($langTable,$this->data['id']);
	        if($langData) {
	            $this->data['name_'.$suffix] = $langData['name'];
	            $jsonData = json_decode($langData['description'],1);
	            if($jsonData) {
	                foreach($jsonData as $key=>$val) {
	                    $this->data[$key."_".$suffix] = $val;
	                }
	            }
	            
	        }
	        
	    }
	    
	    $newDef = $vardef['metadata'][$deftype];
	    
	    foreach($vardef['metadata'][$deftype] as $row) {
	        
	        $addTempRow = false;
	        $temprow = $row;
	        
	        if($row['type']=="row" && isset($row['fields'])) {
	            
	            foreach($row['fields'] as $colkey => $col) {
	                if(isset($col['field']) && ($col['field']['type']=="varchar" || $col['field']['type']=="text")) {
	                    $addTempRow = true;
	                    
	                    if(isset($vardef['fields'][$col['field']['name']])) {
	                        $tempCol = $vardef['fields'][$col['field']['name']];
	                        $tempCol['name'] .= "_".$suffix;
	                        $tempCol['extraclass'] = " language_".$suffix;
	                        $tempCol['label'] = $tempCol['name'];
	                        $vardef['fields'][$tempCol['name']] = $tempCol;
	                        $temprow['fields'][$colkey]['field'] = $tempCol;
	                        
	                    }
	                    
	                    
	                    
	                } else {
	                    unset($temprow['fields'][$colkey]);
	                }
	                
	            }
	        }
	        
	        if($addTempRow) {
	            $newDef[] = $temprow;
	        }
	    }
	    
	    $vardef['metadata'][$deftype] = $newDef;
	    return $vardef;
	}
}