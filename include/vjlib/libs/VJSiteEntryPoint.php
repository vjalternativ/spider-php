<?php
class VJSiteEntryPoint {
    
    
    public $page="home";
    public $method = "action_index";
    public $sitebasePath = "";
    public $view;
    public $bootparams = array();
    function __construct() {
       global $vjconfig,$seoParams,$db;
       
       $this->sitebasePath = 'include/entrypoints/'.$_REQUEST['entryPoint'];
       
       
        if(isset($_REQUEST['page'])) {
            $this->page = $_REQUEST['page'];
            
        }   
        if(isset($seoParams[0]) && file_exists($this->sitebasePath.'/pages/'.$seoParams[0].'/controller.php')) {
                $this->page = $seoParams[0];
        }
        
        
        if(isset($_REQUEST['method'])) {
            $this->method = 'action_'.$_REQUEST['method'];       
        }
        
        if(file_exists($this->sitebasePath.'/pages/'.$this->page.'/controller.php')) {
         
            if($this->page=="page") {
                if(isset($seoParams[0]) && $seoParams[0]) {
                    $sql ="select * from page where alias='".$seoParams[0]."' and deleted=0";
                    $row = $db->getrow($sql);
                    if($row) {
                        
                        $seoParams['pagedata'] = $row;
                        $this->page= "page";
                    }
                    
                    
                    
                }
                
                
            }  else {
                $sql="select * from page where alias='".$this->page."' and deleted=0 ";
                $GLOBALS['seoParams']['pagedata'] = $db->getrow($sql);
                
            }
            
             
            
            
                
            
        } else {
            
                die("404 page not found");
                
            
                
            
        }
        
           
            require_once $vjconfig['fwbasepath'].'include/vjlib/libs/EntryPointController.php';
           
            if(file_exists($this->sitebasePath.'/bootstrap.php')) {
                require_once $this->sitebasePath.'/bootstrap.php';
                $mainController = new bootstrapController();
                $this->bootparams = $mainController->params;
            }
            global $db;
            
            
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
        
        $isfile = $vjlib->loadf($this->sitebasePath.'/layout/'.$vjconfig['sitetpl'].'/'.$vjconfig['sitetpl'].'FooterController.php',false);
        if($isfile) {
            $class = $vjconfig['sitetpl'].'footerController';
            $headerController = new $class;
            $headerController->loadFooter();
        }
        echo $smarty->fetch($this->sitebasePath.'/tpls/'.$vjconfig['sitetpl'].'/footer.tpl');
    }
   
  
}