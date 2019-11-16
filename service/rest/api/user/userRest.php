<?php
require_once 'service/rest/api/ARest.php';
class userRest extends ARest {
    
    
    public function action_login($data)
    {
        $authType = "SpiderAuth";
        
        if(isset($data["authType"])) {
            
        }
    }

    
    
    
}