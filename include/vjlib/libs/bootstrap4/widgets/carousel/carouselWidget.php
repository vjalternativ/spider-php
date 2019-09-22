<?php 
class carouselWidget extends AWidget {
    
    
    function __construct() {
        $this->registerField("image", "file");
        
    }
    public function processWidgetParams($params)
    {
        
        return $params;
    }

    
    
    
        
    
}
?>