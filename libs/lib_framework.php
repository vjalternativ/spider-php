<?php
namespace spider\libs;
$dir = __DIR__.'/';

require_once $dir.'lib_common.php';
require_once $dir.'lib_seo.php';
require_once $dir.'lib_util.php';
require_once $dir.'lib_smarty.php';

class lib_framework {

    private $module;
    private $action;
    private $resource;
    private $record;
    private $sessionName = "ATVSESS";
    private $resourcePath;
    private $usingConigDefaultResource = true;
    protected $configpath = false;


    function __construct($path,$sessionName = false) {
        $this->configpath = $path;
        $this->init($sessionName);
    }

    function init($sessionName = false) {

        $common = new lib_common();
        $common->init($this->configpath);

        $params = lib_seo::getInstance()->getParams();
        $config = lib_config::getInstance($this->configpath)->getConfig();
        $resource = lib_config::getInstance()->get("default_resource");

        if(php_sapi_name() == "cli" && isset($_SERVER['argv']) && $_SERVER['argv']) {
            $resource = 'cli';
            if(isset($_SERVER['argv'][1])) {
                $_GET['module'] = $_SERVER['argv'][1];
            }
            if(isset($_SERVER['argv'][2])) {
                $_GET['action'] = $_SERVER['argv'][2];
            } else {
                $_GET['action'] = 'index';
            }
        } else if(isset($params[0])) {
            $aliasVsResource = array_flip($config['resource_alias']);
            if(isset($aliasVsResource[$params[0]])) {
                $resource  = $aliasVsResource[$params[0]];
                $this->usingConigDefaultResource = false;
            } else if(in_array($params[0],$config['resources'])) {
                $resource = $params[0];
                $this->usingConigDefaultResource = false;
            }
        }

        if(isset($_GET['resource'])) {
            $resource = $_GET['resource'];
        }
        $this->resourcePath = $this->getResourcePath($resource);
        $_GET['resource'] = $resource;
        $this->resource = $resource;


        if(isset($_REQUEST['spiderphp_mode'])) {
            $this->frameworkMode = $_REQUEST['spiderphp_mode'];
        }

        if(isset($_REQUEST['fw_sess_mode'])) {
            $this->sessionName .= '_'.$_REQUEST['fw_sess_mode'];
        } else {
            if($sessionName) {
                $this->sessionName = $sessionName;
            } else {
                $this->sessionName .= '_'.$this->resource;
            }
        }

        $this->initSession($sessionName);
    }


    function getResourceBasePath($relativePath) {
        $libConfig = lib_config::getInstance();
        $path = $libConfig->get("basepath").'resources/'.$this->resource.'/'.$relativePath;
        $fwpath= $libConfig->get("fwbasepath").'resources/'.$this->resource.'/'.$relativePath;
        if(is_dir($path)) {
           return $path;
        } else if(is_dir($fwpath)) {
            return  $fwpath;
        } else {
            return false;
        }
    }

    function _getResourceAbsoluteFilePath($relativePath,$isMandatory=false) {

        $libConfig = lib_config::getInstance();
        $path = $libConfig->get("basepath").'resources/'.$relativePath;
        $fwpath= $libConfig->get("fwbasepath").'resources/'.$relativePath;

        $filename = substr($relativePath,strrpos($relativePath, "/"));

        if(file_exists($path)) {
            $resourcePath = $path;
        } else if(file_exists($fwpath)) {
            $resourcePath =  $fwpath;
        } else {
            if($isMandatory) {
                die("resource not found ".$relativePath);
            }
            return false;


        }

        return substr($resourcePath,0,strrpos($resourcePath,"/")).$filename;
    }


    function getResourcePath($resource) {
        $path = $resource.'/'.ucfirst($resource).'ResourceController.php';
        return  $this->_getResourceAbsoluteFilePath($path);

    }


    private function getResourceDefaultModule($resource) {
        $defaultResourceModules = lib_config::getInstance()->get("default_resource_module");
        if(isset($defaultResourceModules[$resource])) {
           return $defaultResourceModules[$resource];
        } else {
            die("default resource module not specified for ".$resource);
        }
    }

    private function initSession($sessionName=false) {
        //session_name($this->sessionName);
        ini_set('session.gc_maxlifetime', 28800);
        session_set_cookie_params(28800);
        session_start();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        ini_set("memory_limit",-1);
        set_time_limit(0);
        error_reporting(E_ALL);

    }

    function execute() {


        $params = lib_seo::getInstance()->getParams();
        $vjconfig = lib_config::getInstance()->getConfig();
        $resource = $this->resource;
        $resourcePath = $this->resourcePath;


        if(!isset($_GET['module'])) {
            if($this->usingConigDefaultResource) {
                 array_unshift(  $params,$resource);
            }


            if(isset($params[1])) {

                    $_GET['module'] = $params[1];
                    $path= 'modules/'.$params[1].'/';
                    $path = $this->getResourceBasePath($path);
                    if(!$path) {
                        $module =  $this->getResourceDefaultModule($resource);
                        $_GET['module']  = $module;
                    }

            } else {
                $module =  $this->getResourceDefaultModule($resource);
                $_GET['module']  = $module;

            }

            if(isset($params[2])) {
                $_GET['action'] = $params[2];
            } else {
                $defaultResourceActions = lib_config::getInstance()->get("default_resource_action");
                if(isset($defaultResourceActions[$resource])) {
                    $_GET['action'] = $defaultResourceActions[$resource];
                } else {
                     $_GET['action'] = "index";
                }
            }
        }



        $_GET['action'] = isset($_GET['action']) ? $_GET['action'] : 'index';
        $this->module = $_GET['module'];
        $this->action = $_GET['action'];

        $this->record = isset($_GET['record']) ? $_GET['record'] : false;

        //echo $this->resource.' '.$this->module.' '.$this->action;die;

        if(isset($_GET['module']) && isset($_GET['action'])) {
            require_once $vjconfig['fwbasepath'].'resources/ResourceController.php';
            $class= $_GET['module'].ucfirst($_GET['resource']).'Controller';
            $modulePath = $this->_getResourceAbsoluteFilePath($resource.'/modules/'.$_GET['module'].'/'.$class.'.php');
            $pathinterface = $this->_getResourceAbsoluteFilePath($resource.'/modules/'.$_GET['module'].'I'.ucfirst($_GET['module']).ucfirst($_GET['module']).ucfirst($_GET['resource']).'Controller.php');
            require_once $resourcePath;

           if($pathinterface) {
            require_once $pathinterface;
           }

           $class = ucfirst($_GET['resource']).'ResourceController';
           if($modulePath) {
               $class= ucfirst($_GET['module']).ucfirst($_GET['resource']).'Controller';
           } else {
               $modulePath = $resourcePath;
           }

           require_once $modulePath;


           $action = 'action_'.$_GET['action'];

           $vjconfig = lib_config::getInstance()->getConfig();
           if($vjconfig['init_default_modules']) {
               $this->initModules();
           }
           $controller = new $class;



           $entity = lib_entity::getInstance();

           if(!method_exists($controller, $action)) {
               $action = 'action_index';
           }
           if($this->record) {
               $entity->record = $this->record;
           }
               $controller->{$action}();


                if(!empty($controller->view)) {


                    $smarty  = lib_smarty::getSmartyInstance();
                    $smarty->assign("fwbaseurl",$vjconfig['fwbaseurl']);
                    $smarty->assign("fwbasepath",$vjconfig['fwbasepath']);

                    $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
                    $smarty->assign("urlscheme",$scheme);

                    require_once $vjconfig['fwbasepath'].'include/views/ResourceView.php';

                    if(file_exists($vjconfig['basepath'].'resources/'.$this->resource.'/include/views/'.ucfirst($this->resource).'ResourceView'.'.php')) {
                        require_once $vjconfig['basepath'].'resources/'.$this->resource.'/include/views/'.ucfirst($this->resource).'ResourceView'.'.php';
                    } else {
                        require_once $vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/'.ucfirst($this->resource).'ResourceView'.'.php';
                    }


                    if($this->resource=="backend") {
                        require_once $vjconfig['fwbasepath'].'resources/backend/include/views/View.php';
                        require_once $vjconfig['fwbasepath'].'resources/backend/include/views/view.basic.php';
                    }


                    if(file_exists($vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/view.'.$controller->view.'.php')) {
                        require_once $vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/view.'.$controller->view.'.php';
                    }


                    $filepath= $vjconfig['basepath'].'/resources/'.$this->resource.'/modules/' . $this->module .'/views/view.'.$controller->view.'.php';
                    if(!file_exists($filepath)) {
                        $filepath =$vjconfig['fwbasepath'].'/resources/backend/modules/' . $this->module .'/views/view.'.$controller->view.'.php';
                    }
                    $class = $this->module.'View'.ucfirst($controller->view);
                    $isview = true;

                    if(file_exists($filepath)) {
                        require_once $filepath;
                    } else {
                        $isview = false;
                    }
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
                    $params  = $controller->getParams();
                    if($params) {
                        $view->mergeParams($params);
                        $smarty->assign("params",$view->params);
                        if(isset($params['data'])) {
                            $view->data = $params['data'];
                        }
                    }
                    $view->_loadHeader();
                    $view->preDisplay();
                    $view->display();
                    $view->afterDisplay();
                    $view->_loadFooter();
                }




        }

    }

    function setConfigPath($path) {
        $this->configpath = $path;
    }

    function initModules() {

        $dataWrapper = lib_datawrapper::getInstance();
        $globalRelationshipList = lib_datawrapper::getInstance()->get("relationship_list");
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");
        $vjconfig = lib_config::getInstance()->getConfig();
        $entity = lib_entity::getInstance();
        $globalServerPreferenceStoreList = lib_datawrapper::getInstance()->get("server_preference_store_list");
        require_once $vjconfig['fwbasepath'].'resources/backend/include/language/lang.php';
        $langpath = $vjconfig['basepath'].'resources/backend/include/language/lang.php';
        if(file_exists($langpath)) {
            require_once $langpath;
        }

        require_once $vjconfig['fwbasepath'].'include/language/'.$vjconfig['defaultlang'].'.string.php';


        if(file_exists($vjconfig['basepath'].'cache/relationship_list.php')) {

            if(file_exists($vjconfig['basepath'].'cache/relationship_entity_list.php')) {
                require_once $vjconfig['basepath'].'cache/relationship_entity_list.php';
            }
            require_once $vjconfig['basepath'].'cache/relationship_list.php';
            require_once $vjconfig['basepath'].'cache/entity_list.php';
            require_once $vjconfig['basepath'].'cache/module_list.php';

            if(file_exists($vjconfig['basepath'].'cache/server_preference_store_list.php')) {
                require_once $vjconfig['basepath'].'cache/server_preference_store_list.php';
            }

            if($globalModuleList || !isset($_REQUEST['entryPoint']) || $_REQUEST['entryPoint']!="install" ) {
                //  return false;
            }
        }  else {
            $entity->generateCache();
        }
        $dataWrapper->set("entity_list",$globalEntityList);
        $dataWrapper->set("module_list",$globalModuleList);
        $dataWrapper->set("relationship_list",$globalRelationshipList);
        $dataWrapper->set("server_preference_store_list",$globalServerPreferenceStoreList);
        $app_list_strings  = $dataWrapper->get("app_list_strings_list");
        $applistModuleList = array_keys($globalModuleList);
        $app_list_strings['module_list'] =  array_combine($applistModuleList, $applistModuleList);
        $dataWrapper->set("app_list_strings_list",$app_list_strings);
    }

}

?>