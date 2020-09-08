<?php
class breadcrumbWidgetController extends WidgetResourceController {
    public function processWidgetParams($params)
    {
        
        $vjconfig = lib_config::getInstance()->getConfig();
        if(is_array($params)) {
        $foundkey = false;
        
        $alias = $vjconfig['baseurl'];
        
        $alias  = substr($alias,0,-1);
        if(isset($params['prefix'])) {
            $alias .= $params['prefix'];
            
        }
        
        foreach($params as $key=>$val) {
            $foundkey = $key;
            $params[$key] = $val;
            if(isset($val['alias']) && $val['alias']) {
                $alias .= "/".$val['alias'];
            }
            $val['link'] = $alias;
            
            
            
            $params[$key] = $val;
            
        }
        
            
       
            $params[$foundkey]['islast'] = true;
      
            
        }
        
        return $params;
    }

    
}