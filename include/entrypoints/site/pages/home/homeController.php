<?php 

class homeController extends EntryPointController {
    
    function action_index() {
        global $seoParams;
        $this->params['pagedata'] = $seoParams['pagedata'];
        
        $this->bootparams['breadcrumb'] = array();
        
        $this->bootparams['breadcrumb']['home']['title'] = "Home";
        $this->bootparams['breadcrumb']['home']['alias'] = "";
        
        $this->view= 'home';
    }
    
    function action_logout() {
        global $vjconfig;
        session_destroy();
        header("location:".$vjconfig['baseurl']);
    }
}
?>