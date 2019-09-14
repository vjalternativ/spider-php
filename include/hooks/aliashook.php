<?php 
class AliasLogicHook {
    
    
    
    function beforeSave(&$keyvalue) {
        $alias=strtolower($keyvalue['name']);
        $alias=str_replace(' ', '-', $alias);
        if(!isset($keyvalue['alias']) || empty($keyvalue['alias'])) {
            $keyvalue['alias']=$alias;
        }
        
    }
    
   
}
?>