<?php
require_once lib_config::getInstance()->get("fwbasepath").'resources/backend/modules/notification/notificationService.php';

class notificationBackendController extends BackendResourceController {

    function __construct() {
        $this->nonauth['index'] = true;
        $this->nonauth['pullNotifications'] = true;
        $this->nonauth['getRequestId'] = true;
        $this->nonauth['printSession'] = true;
        parent::__construct();
    }



    function action_getRequestId(){
        $this->sendResponse(200, uniqid());
    }



    function action_printSession() {
        echo "<pre>";print_r($_SESSION);die;
    }


    function action_pullNotifications() {


        $this->lockRequest("pullnotification.lock");
        $difTime = 0;

        if(isset($_GET['requestId']) && $_GET['requestId']) {
            $isValid = true;
            $requestId = $_GET['requestId'];
            $clientResource = $_GET['clientResource'];
            $accptedNotificationRequestId =false;

            //echo "request id ".$requestId.PHP_EOL;

            if(isset($_SESSION[$clientResource.'_notification_last_pull_time'])) {
                $lastTime = $_SESSION[$clientResource.'_notification_last_pull_time'];
                //echo "request id ".$requestId.PHP_EOL;

                $rejectCountArray = $_SESSION[$clientResource.'_notification_pull_reject_count'] ? $_SESSION[$clientResource.'_notification_pull_reject_count'] : array();
                $rejectCountArray[$requestId] = isset($rejectCountArray[$requestId]) ? $rejectCountArray[$requestId] : 0;
                $accptedNotificationRequestId = isset($_SESSION[$clientResource.'_notification_accepted_request_id']) ? $_SESSION[$clientResource.'_notification_accepted_request_id'] : "";
                $nowTime = time();
                $difTime =$nowTime - $lastTime;

                if($difTime <  5) {
                    if($accptedNotificationRequestId != $requestId) {
                        if($rejectCountArray[$requestId] >= 1)  {
                            $isValid = false;
                            $this->sendResponse(200, array("status" => "rejected"));

                        } else {

                            $isValid = false;
                            $rejectCountArray[$requestId]++;

                            $_SESSION[$clientResource.'_notification_pull_reject_count'] =$rejectCountArray;
                            $this->sendResponse(200, array("status"=>"tryagain"));
                         }
                    }
                }
            }

            if($isValid) {
                $rejectCountArray[$requestId] = 0;
                $_SESSION[$clientResource.'_notification_last_pull_time'] = time();
                $_SESSION[$clientResource.'_notification_pull_reject_count'] =$rejectCountArray;
                $_SESSION[$clientResource.'_notification_accepted_request_id'] = $requestId;


                $payload = notificationService::getInstance()->fetchMessages($clientResource);
                $this->sendResponse(200, array("status"=>"accepted","payload"=>$payload,"id"=>uniqid()));
            }
        } else {
            $this->sendResponse(401, "request id should not be empty");
        }


    }

    function action_index() {
        echo '<script> var sessionId = "'.session_id().'";</script>';
        echo '<script> var baseurl = "'.lib_config::getInstance()->get("baseurl").'";</script>';
        echo '<script> var fwbaseurl = "'.lib_config::getInstance()->get("fwbaseurl").'";</script>';
        echo '<script> var resource = "'.$_GET['clientResource'].'";</script>';
        echo '<script src="'.lib_config::getInstance()->get("fwbaseurl").'libs/assets/js/lib_desktopnotification.js?v=1"></script>';
        echo '<script src="'.lib_config::getInstance()->get("fwbaseurl").'resources/backend/assets/js/jquery-3.1.1.min.js"></script>';
        echo '<script src="'.lib_config::getInstance()->get("fwbaseurl").'resources/backend/modules/notification/assets/js/notification.js"></script>';
    }
}
?>