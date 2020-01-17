<?php
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/abstract/AWidget.php';

class EntryPointController {
    
    public $params = array();
    public $view=  "";
    public $bootparams = array();
    public $headerparams = array();
    public $footerparams = array();
    public $redirectView = false;
    public $routes = array();
    public $page = "";
    public $method = "";
    
    function __construct() {
        global $vjconfig;
        $class = get_called_class();
        $class = str_replace("Controller", "", $class);
        
        $this->bootparams['controller_path']  = 'include/entrypoints/site/pages/'.$class.'/';
        $this->bootparams['controller_tpl_path']  = 'include/entrypoints/site/pages/'.$class.'/tpls/'.$vjconfig['sitetpl'].'/';
        $this->bootparams['current_url'] = $_SERVER['REQUEST_URI'];
    }
    
    function displayView($view) {
        global $vjconfig;
        
        $class = get_class($this);
        $class = str_replace("Controller", "", $class);
        
        
        require_once $vjconfig['fwbasepath'].'include/views/EntryPointView.php';
        require_once "include/entrypoints/site/pages/".$class."/views/view.".$view.".php";
        $viewClass = $class."View".ucfirst($view);
        $viewOb = new $viewClass();
        $viewOb->pagetplpath = $vjconfig['basepath'].'include/entrypoints/site/pages/' . $class .'/tpls/'.$vjconfig['sitetpl'].'/';
        $viewOb->loadHeader();
        $viewOb->display();
    }
    
    
    function redirectView($page,$method) {
        $this->redirectView['page'] = $page;
        $this->redirectView['method'] = 'action_'.$method;
    }
    
    
    function rendorTpl($tpl,$params=array()) {
        global $smarty,$vjconfig;
        
        $params +=  $this->params;
        $smarty->assign("params",$params);
        $smarty->assign("baseurl",$vjconfig['baseurl']);    
        $class = get_called_class();
        $class = str_replace("Controller", "", $class);
        
        $this->bootparams['controller_path']  = 'include/entrypoints/site/pages/'.$class.'/';
        $this->bootparams['controller_tpl_path']  = 'include/entrypoints/site/pages/'.$class.'/tpls/'.$vjconfig['sitetpl'].'/';
        
        return $smarty->fetch($this->bootparams['controller_tpl_path'].$tpl);
    
    }
    
    
    function registerBreadcrumb($id,$title,$alias,$params=array()) {
        $this->bootparams['breadcrumb'][$id]['title'] = $title;
        $this->bootparams['breadcrumb'][$id]['alias'] = $alias;
        $this->bootparams['breadcrumb'][$id]['params'] = $params;
        
    }
    
    function action_index() {
        
        global $seoParams;
        
        $this->bootparams['breadcrumb']['home']['title'] = "Home";
        $this->bootparams['breadcrumb']['home']['alias'] = '';
        
        if($this->routes) {
            foreach($this->routes as $key=>$val) {
                if(isset($seoParams[$key])) {
                    
                    $method = 'action_'.$val;
                    $this->{$method}();
                }
            }
        } else {
            end($seoParams);
            $method = prev($seoParams);
            if(method_exists($this,"action_".$method )) {
                $this->{"action_".$method}();
            }
            
        }
        
        
        
    }
}

?>