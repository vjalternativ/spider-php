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
		$vjlib->BootStrap->vars['path'] =$vjconfig['fwbasepath']."include/vjlib/assets/";
		$this->seourl = $seourl;
		
		
		$globalRelationshipList = $db->fetchRows("select * from relationships where deleted=0",array("name"));
		
		
		
		$globalEntityList = $db->fetchRows("select * from tableinfo where deleted=0",array("id"));
		foreach($globalEntityList as $module) {
		    $globalModuleList[$module['name']]  = $module;
		    $globalModuleList[$module['name']]['tableinfo'] = json_decode(base64_decode($module['description']),1);
		   
		    
		    
		    
		    if(isset($globalModuleList[$module['name']]['tableinfo']['metadata']['editview'])) {
		           foreach($globalModuleList[$module['name']]['tableinfo']['metadata']['editview'] as $metakey=>$row) {
		              if(isset($row['fields'])) {
		                  foreach($row['fields'] as $fkey=>$fieldarray) {
		                      $globalModuleList[$module['name']]['metadata_info']['editview']['fields'][$fieldarray['field']['name']] = 1;
		                  }
		              }
		          }
		      }
		}
		
		
		
		foreach($globalRelationshipList as $relationship) {
		    if(isset($globalEntityList[$relationship['primarytable']])) {
		        if(isset($globalModuleList[$globalEntityList[$relationship['primarytable']]['name']])) {
		            $globalModuleList[$globalEntityList[$relationship['primarytable']]['name']]['relationships'][$relationship['name']]  = $relationship;
		        }
		        else if(isset($globalModuleList[$globalEntityList[$relationship['secondarytable']]['name']])) {
		            $globalModuleList[$globalEntityList[$relationship['secondarytable']]['name']]['relationships'][$relationship['name']]  = $relationship;
		        }
		        
		        
		    }
		}
		
		
		if($this->seourl) {
			$this->processSeoUrl();
		}
		
		
		if(!isset($_REQUEST['module']) && !isset($_REQUEST['entryPoint']) && isset($vjconfig['framework']['default_mode']) && $vjconfig['framework']['default_mode']=="entryPoint") {
		    $_REQUEST['entryPoint'] = $vjconfig['framework']['default_entrypoint'];
		      
		}
		
		if(isset($_REQUEST['entryPoint'])) {
			$entrypoint = $_REQUEST['entryPoint'];
			
			require_once $vjconfig['fwbasepath']."include/entrypointregistry.php";
			$vjlib->loadf("custom/include/entrypointregistry.php",false);
			if(!isset($entrypoints[$entrypoint])) {
				die("entry point not found in entry point registry");
			}
				
			//$filepath = $entrypoints[$entrypoint]['path'];
			
			//require_once $filepath;
			if(isset($entrypoints[$entrypoint]['type']) && $entrypoints[$entrypoint]['type']=='siteEntryPoint') {
			    require_once $vjconfig['fwbasepath'].'/include/vjlib/libs/VJSiteEntryPoint.php';
			    $siteEntryPoint = new VJSiteEntryPoint();
			    
			    
			}
			return;
			
		}
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
		
		$this->loadController ();
	}
	function loadController() {
		
		global $vjlib,$vjconfig,$current_user,$entity,$smarty;
		
		$vjconfig['basepath'] = $vjconfig['fwbasepath'];
		$vjconfig['baseurl'] = $vjconfig['fwbaseurl'];
		
		$smarty->assign("baseurl",$vjconfig['fwbaseurl']);
		
		$vjlib->loadlib('VJController');
		
		$vjlib->loadf($vjconfig['fwbasepath'].'include/views/View.php');
		
		$class = "VJController";
		
		$filepath = 'custom/modules/' . $this->module . '/controller.php';
		$iscustom = $vjlib->loadf ($filepath,false);
		
		$filepath = $vjconfig['fwbasepath'].'modules/' . $this->module . '/language/'.$vjconfig['defaultlang'].'.string.php';
		$vjlib->loadf ($filepath,false);
		
		$filepath = 'custom/modules/' . $this->module . '/language/'.$vjconfig['defaultlang'].'.string.php';
		$vjlib->loadf ($filepath,false);
		
		
		$prefix = "";
		if($iscustom) {
		    $prefix = $vjconfig['fwbasepath']."custom/";
		}
		
		$filepath = $prefix.'modules/' . $this->module . '/controller.php';
		$iscustom = $vjlib->loadf ($filepath,false);
		if($iscustom) {
		$class = $this->module.'Controller';
		}
		$methods = get_class_methods ( $class );
		
		$controller = new $class;
		$controller->seourl = $this->seourl;
		$controller->seoparams = $this->seoparams;
		$controller->entity = strtolower($this->module);

			$current_user = sessioncheck('current_user');
		
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
				}
		
				$controller->{'action_' . $this->action} ();
		
		
			} else {
				$controller->action_index();
				
			}
			
					
			if(!empty($controller->view)) {
				$entity->record = $this->record;
				$vjlib->loadf($vjconfig['basepath'].'include/views/view.basic.php');
				
				$isdefaultview = $vjlib->loadf('include/views/view.'.$controller->view.'.php',false);
				$filepath =$prefix.'modules/' . $this->module .'/views/view.'.$controller->view.'.php';
				
				//die($vjconfig['basepath'].$filepath);
				
				$customview = $vjlib->loadf($vjconfig['basepath'].$filepath,false);
				$class = $this->module.'View'.ucfirst($controller->view);
				
				if(!$customview) {
				$class = 'View'.ucfirst($controller->view);
				} 
				
				
				
				$view = new $class;
				if(isset($controller->listview))
				$view->listview = $controller->listview;
				
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