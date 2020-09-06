<?php 
class carouselWidgetController extends WidgetResourceController {
    
    
    function __construct() {
        $this->registerField("image", "file");
        
    }
    public function processWidgetParams($params)
    {
        
        return $params;
    }

    
    
    
        
    
}
?>