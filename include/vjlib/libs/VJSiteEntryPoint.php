<?php
class VJSiteEntryPoint {
    
    
    public $page="home";
    public $method = "action_index";
    public $sitebasePath = "";
    public $view;
    public $bootparams = array();
    function __construct() {
       global $vjconfig; 
       $this->sitebasePath = 'include/entrypoints/'.$_REQUEST['entryPoint'];
       
       
        if(isset($_REQUEST['page'])) {
            $this->page = $_REQUEST['page'];
        }
        
        
        if(isset($_REQUEST['method'])) {
            $this->method = 'action_'.$_REQUEST['method'];       
        }
        
        if(file_exists($this->sitebasePath.'/pages/'.$this->page.'/controller.php')) {
           
            require_once $vjconfig['fwbasepath'].'include/vjlib/libs/EntryPointController.php';
           
            if(file_exists($this->sitebasePath.'/bootstrap.php')) {
                require_once $this->sitebasePath.'/bootstrap.php';
                $mainController = new bootstrapController();
                $this->bootparams = $mainController->params;
            }
            
            
            require_once $this->sitebasePath.'/'.'pages/'.$this->page.'/controller.php';
          
            $class = $this->page.'Controller';
            $pageController = new $class();
            $pageController->bootparams = $this->bootparams;
            
            if(!method_exists($pageController,$this->method)) {
                $this->method="action_index";
            } 
            $pageController->{$this->method}();
            $this->bootparams = $pageController->bootparams;
            
            if(!empty($pageController->view)) {
                
               
                require_once $vjconfig['fwbasepath'].'include/views/EntryPointView.php';
                
                $filepath =$this->sitebasePath.'/pages/' . $this->page .'/views/view.'.$pageController->view.'.php';
                
                require_once $filepath;
                
                
                $class = $this->page.'View'.ucfirst($pageController->view);
                $view = new $class;
                $view->sitetpl = $vjconfig['sitetpl'];
                $view->bootparams = $this->bootparams;
                $view->pagetplpath = $this->sitebasePath.'/pages/' . $this->page .'/tpls/'.$vjconfig['sitetpl'].'/';
                if(!empty($pageController->params)) {
                    $view->params = $pageController->params;
                }
                $this->view = $view;
                $this->loadHeader();
                
                $view->display();
                
                $this->loadFooter();
            
            }
            
            
            
        } else {
            die("404 page not found");
        }
        
        
        
        
        
        
        
    }
    
    
    function display() {
        
    }
    
    function loadHeader(){
        
        global $smarty,$vjconfig,$vjlib;
        
        
        $smarty->assign("basepath",$vjconfig['basepath']);
        $smarty->assign("baseurl",$vjconfig['baseurl']);
        $smarty->assign("params",$this->view->params);
        $smarty->assign("bootparams",$this->bootparams);
        echo "<script>var baseurl = '".$vjconfig['baseurl']."';</script>";
        echo "<script>var fwbaseurl = '".$vjconfig['fwbaseurl']."';</script>";
        
        $isfile = $vjlib->loadf($this->sitebasePath.'/layout/'.$vjconfig['sitetpl'].'/'.$vjconfig['sitetpl'].'HeaderController.php',false);
        
        if($isfile) {
            $class = $vjconfig['sitetpl'].'HeaderController';
            
            $headerController = new $class;
            $headerController->loadHeader();
        }
        echo $smarty->fetch($this->sitebasePath.'/tpls/'.$vjconfig['sitetpl'].'/header.tpl');
        
        
    }
    
    function loadFooter(){
        global $smarty,$vjconfig,$vjlib;
        $smarty->assign("basepath",$vjconfig['basepath']);
        $smarty->assign("baseurl",$vjconfig['baseurl']);
        $smarty->assign("params",$this->view->params);
        
        $isfile = $vjlib->loadf($this->sitebasePath.'/layout/'.$vjconfig['sitetpl'].'/footer.php',false);
        if($isfile) {
            $class = $this->bootparams['sitetpl'].'footerController';
            
            $headerController = new $class;
            $headerController->loadFooter();
        }
        echo $smarty->fetch($this->sitebasePath.'/tpls/'.$vjconfig['sitetpl'].'/footer.tpl');
    }
   
  
}