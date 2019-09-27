<?php
class breadcrumbWidget extends AWidget {
    public function processWidgetParams($params)
    {
        if(is_array($params)) {
        $foundkey = false;
        foreach($params as $key=>$val) {
            $foundkey = $key;
        }
        
        $params[$foundkey]['islast'] = true;
        }
        
        return $params;
    }

    
}