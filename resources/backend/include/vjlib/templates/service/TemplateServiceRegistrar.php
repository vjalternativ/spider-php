<?php 

class TemplateServiceRegistrar {
    
    static $instance = null;
    
    static function getInstance() {
        
        if(self::$instance==null) {
            $instance = new TemplateService();
        }
        return self::getITemplateService($instance);
    }
    
    private function getITemplateService(ITemplateService $ob) {
        return  $ob;
    }
    
}
?>