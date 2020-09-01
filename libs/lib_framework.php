<?php
$dir = __DIR__.'/';
require_once $dir.'lib_seo.php';
require_once $dir.'lib_util.php';

class lib_framework {

    private $module;
    private $action;
    private $resource;
    private $record;
    private $sessionName = "ATVSESS";
    private $resourcePath;

    function __construct($sessionName = false) {

        $params = lib_seo::getInstance()->getParams();


        $resource = isset($params[0]) ? $params[0] : lib_config::getInstance()->get("default_resource");
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


    private function initSession($sessionName=false) {
        session_name($this->sessionName);
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

        $resource = $this->resource;
        $resourcePath = $this->resourcePath;

        if(!isset($_GET['module'])) {
            if(isset($params[1])) {
                    $_GET['module'] = $params[1];
            } else {
                $defaultResourceModules = lib_config::getInstance()->get("default_resource_module");
                if(isset($defaultResourceModules[$resource])) {
                    $_GET['module'] = $defaultResourceModules[$resource];
                } else {
                    die("default resource module not specified");
                }
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

        if(isset($_GET['module']) && isset($_GET['action'])) {


            $class= ucfirst($_GET['module']).ucfirst($_GET['resource']).'Controller';

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

               $controller = new $class;

               $vjconfig = lib_config::getInstance()->getConfig();
               $entity = lib_entity::getInstance();


               if(method_exists($controller, $action)) {
                   $controller->{$action}();


                    if(!empty($controller->view)) {

                        require_once $vjconfig['fwbasepath'].'libs/lib_smarty.php';

                        $smarty  = lib_smarty::getSmartyInstance();
                        $smarty->assign("fwbaseurl",$vjconfig['fwbaseurl']);
                        $smarty->assign("fwbasepath",$vjconfig['fwbasepath']);

                        $entity->record = $this->record;
                        require_once $vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/View.php';
                        require_once $vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/view.basic.php';
                        if(file_exists($vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/view.'.$controller->view.'.php')) {
                            require_once $vjconfig['fwbasepath'].'resources/'.$this->resource.'/include/views/view.'.$controller->view.'.php';
                        }


                        $filepath= $vjconfig['basepath'].'custom/modules/' . $this->module .'/views/view.'.$controller->view.'.php';
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
               } else {
                   die("404");
               }



        }

    }

}

?>