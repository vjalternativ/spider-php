<?php
class chatViewIndex extends ResourceView {


    function display() {

       $smarty = lib_smarty::getSmartyInstance();
       $current_user = lib_current_user::getEntityInstance();
       $vjconfig = lib_config::getInstance()->getConfig();

       $isAgentForLiveChat = false;
       $heading = "Live Chat With Us";
       if($current_user && isset($current_user->privileges['agent.live.chat'])) {
           $isAgentForLiveChat = true;
           $heading ="Live Chat Box";
       }
       $smarty->assign("heading",$heading);
       $smarty->assign("is_agent_livechat",$isAgentForLiveChat);
       echo $smarty->fetch($vjconfig['fwbasepath']."resources/backend/modules/chat/tpls/index.tpl");

    }


    function displayHeader() {
        if(isset($_REQUEST['fw_sess_mode'])) {
            echo "<script> var fw_sess_mode ='".$_REQUEST['fw_sess_mode']."' </script>";
        }
        if(isset($_REQUEST['autoconnect'])) {
            echo "<script> var autoconnect = true; </script>";
        } else {
            echo "<script> var autoconnect = false; </script>";

        }
    }

    function displayFooter() {

    }

    function loadFooter() {

    }
    public function loadHeader()
    {}

}

?>