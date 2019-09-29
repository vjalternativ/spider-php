<?php

class EntryPointController {
    
    public $params = array();
    public $view=  "";
    public $bootparams = array();
    public $redirectView = false;
    
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
}

//$p = new EntryPointController();


//var_dump($params);
?>