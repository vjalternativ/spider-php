<?php 
class topheaderWidgetController extends WidgetResourceController {
    
    
    function __construct() {
        $this->registerField("link", "varchar");
        
    }
    public function processWidgetParams($params)
    {
        return $params;
    }

    
    
    
        
    
}
?>