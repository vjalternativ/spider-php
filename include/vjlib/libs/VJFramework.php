<?php 
global $seoparams,$db,$current_user,$current_url,$app_list_strings,$vjconfig,$mod_string,$log,$smarty,$globalRelationshipList,$globalEntityList,$globalModuleList; 
require_once $vjconfig['fwbasepath'].'include/language/lang.php';
require_once $vjconfig['fwbasepath'].'include/language/'.$vjconfig['defaultlang'].'.string.php';

$seoparams = array ();
require_once $vjconfig['fwbasepath'].'include/utils.php';
require_once $vjconfig['fwbasepath'].'include/vjlib/libs/Modal.php';
class VJFramework {
	public $module;
	public $action;
	public $single_param_module;
	public $single_param_action;
	public $seourl = false;
	public $seoparams = array();
	public $record = false;
	//TO DO : to explore global variable vs class data attribute which is best way
	
	function initModules() {
	    global $globalRelationshipList,$globalModuleList,$db,$globalEntityList,$vjconfig,$entity;
	    if(file_exists($vjconfig['fwbasepath'].'cache/relationship_list.php')) {
    	    require_once $vjconfig['fwbasepath'].'cache/relationship_list.php';
    	    require_once $vjconfig['fwbasepath'].'cache/entity_list.php';
    	    require_once $vjconfig['fwbasepath'].'cache/module_list.php';
    	    
    	    if($globalModuleList || !isset($_REQUEST['entryPoint']) || $_REQUEST['entryPoint']!="install" ) {
    	       return false;
    	    }
	    }  else {
	        $entity->generateCache();
	    }
	    
	    
	
	}
	
	
	function __construct($seourl = false) {
		
	    global $vjlib,$db,$vjconfig,$entity,$app_list_strings,$log,$smarty,$globalRelationshipList,$globalEntityList,$globalModuleList;
		$this->module = $vjconfig['framework']['default_module'];
		$this->action = $vjconfig['framework']['default_action'];
		$this->seourl = $vjconfig['framework']['seourl'];
		$db =$vjlib->MysqliLib;
		$entity = $vjlib->Entity;
		$log = $vjlib->Logger;
		
		$smarty = new Smarty();
		$smarty->assign("urlbasepath",$vjconfig['urlbasepath']);
		$smarty->assign("fwbaseurl",$vjconfig['fwbaseurl']);
		$db->connect($vjconfig['mysql']['host'],$vjconfig['mysql']['user'],$vjconfig['mysql']['password'],$vjconfig['mysql']['database']);
		$vjlib->BootStrap->vars['path'] ="include/vjlib/assets/";
		$this->seourl = $seourl;
		$this->initModules();
		
		
		if($this->seourl) {
			$this->processSeoUrl();
		}
		
		
		
		
		$current_user = sessioncheck('current_user');
		
		
		if (isset ( $_REQUEST ['module'] )) {
		    $this->module = $_REQUEST ['module'];
		    if(!isset($_REQUEST['action'])) {
		        $this->action = 'index';
		    }
		}
		if (isset ( $_REQUEST ['action'] )) {
		    $this->action = $_REQUEST ['action'];
		}
		
		if (isset ( $_REQUEST ['record'] )) {
		    $this->record = $_REQUEST ['record'];
		}
		
		
		if($vjconfig['fw_mode']=="REST") {
		    
		        require_once $vjconfig['fwbasepath'].'service/rest/restController.php';
		        $ob  = new restController();
		        $ob->execute();
		} else {
		    
		   if($vjconfig['fw_mode']=="FRONTEND" ) {
		        if(!isset($_REQUEST['entryPoint'])) {
		            $_REQUEST['entryPoint'] = $vjconfig['framework']['default_entrypoint'];
		        }
		   }
		    
		    
		   if(isset($_REQUEST['entryPoint'])) {
		       $entrypoint = $_REQUEST['entryPoint'];
		       $entrypoints =array();
		       require_once $vjconfig['fwbasepath']."include/entrypointregistry.php";
		       if(file_exists($vjconfig['basepath']."custom/include/entrypointregistry.php")) {
		           require_once $vjconfig['basepath']."custom/include/entrypointregistry.php";
		       }
		       
		       if(!isset($entrypoints[$entrypoint])) {
		           die("entry point not found in entry point registry");
		       }
		       if(isset($entrypoints[$entrypoint]['type']) && $entrypoints[$entrypoint]['type']=='siteEntryPoint') {
		           require_once $vjconfig['fwbasepath'].'/include/vjlib/libs/VJSiteEntryPoint.php';
		           new VJSiteEntryPoint();
		           
		           
		       } else {
		           $filepath = $entrypoints[$entrypoint]['path'];
		           require_once $filepath;
		           
		       }
		       
		   } else if($vjconfig['fw_mode']=="BACKEND") {
		       $this->loadController ();
		   }
		    
		    
		    
		    
		    
		}
		
		
		
		
	
	
	}
	function loadController() {
		
	    global $vjlib,$vjconfig,$current_user,$entity,$smarty,$globalModuleList;
		
		
		$smarty->assign("baseurl",$vjconfig['fwbaseurl']);
		
		$vjlib->loadlib('VJController');
		
		$vjlib->loadf($vjconfig['fwbasepath'].'include/views/View.php');
		
		$class = "VJController";
		
		
		$filepath = $vjconfig['fwbasepath'].'modules/' . $this->module . '/language/'.$vjconfig['defaultlang'].'.string.php';
		$vjlib->loadf ($filepath,false);
		
		$filepath = 'custom/modules/' . $this->module . '/language/'.$vjconfig['defaultlang'].'.string.php';
		$vjlib->loadf ($filepath,false);
		
		
		
		$filepath = 'custom/modules/' . $this->module . '/controller.php';
		$iscustom = $vjlib->loadf ($filepath,false);
		
		$prefix = "";
		if($iscustom) {
		    $prefix = $vjconfig['fwbasepath']."custom/";
		    $class = $this->module.'Controller';
		}
		
		$filepath = $vjconfig['basepath'].'custom/modules/' . $this->module . '/controller.php';
		$iscustom = $vjlib->loadf ($filepath,false);
		if($iscustom) {
		    $prefix = $vjconfig['basepath']."custom/";
		    $class = $this->module.'Controller';
		    
		} else {
		    $filepath = $vjconfig['fwbasepath'].'/modules/' . $this->module . '/controller.php';
		    $iscustom = $vjlib->loadf ($filepath,false);
		    if($iscustom) {
		        $prefix = $vjconfig['basepath']."/";
		        $class = $this->module.'Controller';
		        
		    }
		}
		
		
		$methods = get_class_methods ( $class );
		
		$controller = new $class;
		$controller->seourl = $this->seourl;
		$controller->seoparams = $this->seoparams;
		$controller->entity = strtolower($this->module);

		
		
			$entity->module = $this->module;
			$tableinfo = $entity->getwhere("tableinfo","name='".$this->module."'");
			$entity->tableinfo = $tableinfo;
			
			
			if($this->record) {
			    $entity->record = $this->record;
			    $data = $entity->get($this->module,$this->record);
			    $controller->params['data'] = $data;
			    
			}
			
			
			
			if (in_array ( 'action_' . $this->action, $methods )) {
		
				if(!isset($controller->nonauth[$this->action]) && !$current_user) {
					die("Invalid Session");
				} else  {
				    if(isset($controller->nonauth[$this->action]) && $current_user && isset($controller->nonauth[$this->action]['redirect'])) {
						redirect($controller->nonauth[$this->action]['redirect']['module'], $controller->nonauth[$this->action]['redirect']['action']);
					} 
					
					if(!isset($controller->nonauth[$this->action]) && $current_user) {
					    if(!$current_user->isDeveloper) {
					        if(!(isset($globalModuleList[$this->module]) && isset($current_user->module_access[$globalModuleList[$this->module]['id']])  && $current_user->module_access[$globalModuleList[$this->module]['id']]['module_access'])) {
    					           die("Access denied !");       
    					    }
					    }
					}
				}
		
				$controller->{'action_' . $this->action} ();
		
		
			} else {
				$controller->action_index();
				
			}
			
			if(!empty($controller->view)) {
				$entity->record = $this->record;
				$vjlib->loadf($vjconfig['fwbasepath'].'include/views/view.basic.php');
				
				$vjlib->loadf($vjconfig['fwbasepath'].'include/views/view.'.$controller->view.'.php',false);
				$filepath= $vjconfig['basepath'].'custom/modules/' . $this->module .'/views/view.'.$controller->view.'.php';
				if(!file_exists($filepath)) {
				    $filepath =$vjconfig['fwbasepath'].'modules/' . $this->module .'/views/view.'.$controller->view.'.php';
				
				}
				
				
				$isview = $vjlib->loadf($filepath,false);
				
				$class = $this->module.'View'.ucfirst($controller->view);
				
				if(!$isview) {
				$class = 'View'.ucfirst($controller->view);
				} 
				
				
				$view = new $class;
				
				if(isset($controller->listview)) {
				    $view->listview += $controller->listview;
				}
				$view->module = $this->module;
				if($this->record) {
					$view->record = $this->record;
				}
				if(!empty($controller->params)) {
					$view->params = $controller->params;		
					if(isset($controller->params['data'])) {
					    $view->data = $controller->params['data'];
					}
				}
				$view->loadHeader();
				$view->preDisplay();
				
				
				$view->display();
				$view->afterDisplay();
				$view->loadFooter();
			}
			
	}
	function processSeoUrl() {
		global $seoparams;
		
		// use either global or by object property
		$seoparams = $this->getParams ();
		$this->seoparams = $seoparams;
		
		if (count ( $seoparams ) == 1) {
			$this->module = $this->single_param_module;
			$this->action = $this->single_param_action;
		} else if (count ( $seoparams ) > 1) {
			$this->module = $seoparams [0];
			$this->action = $seoparams [1];
		}
	}
	function getParams() {
		global $sugar_config,$current_url;
		$params = array ();
		$baseUrlCount = strlen ( $sugar_config ['base_url'] );
		$url = substr ( $_SERVER ['REQUEST_URI'], $baseUrlCount );
		$current_url = $url;
		if ($url == '') {
			return $params;
		}
		$params = explode ( '/', $url );
		return $params;
	}
	
	
	
}

?>