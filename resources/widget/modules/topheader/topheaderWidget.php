<?php 
class topheaderWidget extends AWidget {
    
    
    function __construct() {
        $this->registerField("link", "varchar");
        
    }
    public function processWidgetParams($params)
    {
        return $params;
    }

    
    
    
        
    
}
?>