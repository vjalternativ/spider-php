<?php 
class chatViewIndex extends ViewBasic {
    
    
    function display() {
        
       global $smarty,$current_user;
       $isAgentForLiveChat = false;
       $heading = "Live Chat With Us";
       if($current_user && isset($current_user->privileges['agent.live.chat'])) {
           $isAgentForLiveChat = true;
           $heading ="Live Chat Box";
       }
       $smarty->assign("heading",$heading);
       $smarty->assign("is_agent_livechat",$isAgentForLiveChat);
       echo $smarty->fetch("modules/chat/tpls/index.tpl");
        
    }
    
    
    function loadHeader() {
        
    }
    
    function loadFooter() {
        
    }
}

?>