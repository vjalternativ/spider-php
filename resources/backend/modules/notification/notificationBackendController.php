<?php
require_once lib_config::getInstance()->get("fwbasepath").'resources/backend/modules/notification/notificationService.php';

class notificationBackendController extends BackendResourceController {

    function __construct() {
        $this->nonauth['index'] = true;
        $this->nonauth['pullNotifications'] = true;
        $this->nonauth['getRequestId'] = true;
        parent::__construct();
    }



    function action_getRequestId(){
        $this->sendResponse(200, uniqid());
    }


    private function fetchMessages() {
        require_once lib_config::getInstance()->get("fwbasepath").'resource/backend/module/notification/notificationService.php';
        $notificationPaths = notificationService::getInstance()->getNotificationPaths();
        $messages  =array();
        foreach($notificationPaths as $path) {
            $path = lib_config::getInstance()->get("basepath").'cache/notifications/'.$path;
            $files = scandir($path);
            unset($files[0]);
            unset($files[1]);
            foreach($files as $file){
                $messages[] = file_get_contents($path.'/'.$file);
                unlink($path.'/'.$file);
            }

        }
        return $messages;
    }

    function action_pullNotifications() {



        if(isset($_SESSION['last_pull_notification_time'])) {
            $lastTime = $_SESSION['notification_last_pull_time'];
            $rejectCount = $_SESSION['notification_pull_reject_count'];
            $accptedNotificationRequestId = isset($_SESSION['notification_accepted_request_id']) ? $_SESSION['notification_accepted_request_id'] : false;
            $requestId = $_GET['requestId'];
            $nowTime = time();
            $difTime =$nowTime - $lastTime;
            if($difTime <  5) {
                if($accptedNotificationRequestId != $requestId) {
                    if($rejectCount < 2)  {
                        $this->sendResponse(200, array("status" => "rejected"));
                    } else {
                        $this->sendResponse(200, array("status"=>"tryagain"));
                        $_SESSION['notification_pull_reject_count'] +=1;
                    }
                }
            }
        }
        $_SESSION['notification_last_pull_time'] = time();
        $_SESSION['notification_accepted_request_id'] = $requestId;
        $_SESSION['notification_pull_reject_count'] = 0;

        $payload = notificationService::getInstance()->fetchMessages();
        $this->sendResponse(200, array("status"=>"accepted","payload"=>$payload));

    }

    function action_index() {
        echo '<script> var sessionId = "'.session_id().'";</script>';
        echo '<script> var baseurl = "'.lib_config::getInstance()->get("baseurl").'";</script>';
        echo '<script src="'.lib_config::getInstance()->get("fwbaseurl").'resources/backend/assets/js/jquery-3.1.1.min.js"></script>';
        echo '<script src="'.lib_config::getInstance()->get("fwbaseurl").'resources/backend/modules/notification/assets/js/notification.js"></script>';
    }
}
?>