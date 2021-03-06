<?php
class chatViewIndex extends BackendResourceView {


    function display() {

       $smarty = lib_smarty::getSmartyInstance();
       $current_user = lib_current_user::getEntityInstance();
       $vjconfig = lib_config::getInstance()->getConfig();

       $isAgentForLiveChat = false;
       $heading = "Live Chat With Us";
       if($current_user && $this->params['clientResource']=="backend" ) {

           if(isset($current_user->privileges['agent.live.chat'])) {
               $isAgentForLiveChat = true;
               $heading ="Live Chat Box";
           }
       }
       $smarty->assign("heading",$heading);
       $smarty->assign("is_agent_livechat",$isAgentForLiveChat);
       echo $smarty->fetch($vjconfig['fwbasepath']."resources/backend/modules/chat/tpls/index.tpl");

    }


    function _loadHeader() {
        if(isset($_REQUEST['fw_sess_mode'])) {
            echo "<script> var fw_sess_mode ='".$_REQUEST['fw_sess_mode']."' </script>";
        }
        if(isset($_REQUEST['autoconnect'])) {
            echo "<script> var autoconnect = true; </script>";
        } else {
            echo "<script> var autoconnect = false; </script>";

        }




        if( $this->params['clientResource']=="frontend") {

             if(isset($_SESSION['frontend_active_room_id'])) {
                echo "<script> var isFrontendRoomActive = true; </script>";
                echo '<script> var frontendActiveRoomId = "'.$_SESSION['frontend_active_room_id'].'"; </script>';
                echo '<script> var frontendActiveMemberId = "'.$_SESSION['frontend_active_member_id'].'"; </script>';
            } else {
                echo "<script> var isFrontendRoomActive = false; </script>";
            }
        }

        echo '<script> var sessionId = "'.session_id().'"; </script>';


        if($this->params['showheaderfooter']) {
            parent::_loadHeader();
        }
    }

    function _loadFooter() {
        if($this->params['showheaderfooter']) {
            parent::_loadFooter();
        }
    }



}

?>