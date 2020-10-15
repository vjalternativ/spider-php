<?php
class notificationService {

    private static $instance = null;


    static function getInstance()  {
        if(self::$instance==null) {
            self::$instance = new notificationService();
        }
        return self::$instance;
    }


    public function registerNotificationPath($resource,$type,$relativepath,$once=true) {
        $cmd = "mkdir -p ".lib_config::getInstance()->get("basepath").'cache/notifications/'.$relativepath;
        shell_exec($cmd);
        $_SESSION[$resource.'_notification_path'][$type] = $relativepath;
    }


    function broadcastNotification($relativepath,$id,$message) {
        $this->broadcast($relativepath, $id, array("type"=>"notification","data"=>$message));
    }


    public function broadcastMessage($relativepath,$id,$message) {
            $this->broadcast($relativepath, $id, array("type"=>"message","data"=>$message));
    }

    private function broadcast($relativepath,$id,$data) {
        $path = lib_config::getInstance()->get("basepath").'cache/notifications/'.$relativepath;
        $files = scandir($path);
        if($files) {
            unset($files[0]);
            unset($files[1]);
            $msgId =uniqid();
            foreach($files as $directory) {
                $participantPath = $path.'/'.$directory.'/';
                if(is_dir($participantPath) && $directory !=$id) {
                    file_put_contents($participantPath.$msgId, json_encode($data));
                }
            }
        }
    }

    private function getNotificationPaths($clientResource) {
        return isset($_SESSION[$clientResource.'_notification_path']) ? $_SESSION[$clientResource.'_notification_path'] : array();
    }

    public function fetchMessages($clientResource) {
        $notificationPaths = $this->getNotificationPaths($clientResource);
        $messages  =array();
        foreach($notificationPaths as  $type => $path) {
            $path = lib_config::getInstance()->get("basepath").'cache/notifications/'.$path;
            $files = scandir($path);
            unset($files[0]);
            unset($files[1]);
            foreach($files as $file){

                $json = file_get_contents($path.'/'.$file);
                $jsonData = json_decode($json,1);
                $messages[] = array("type"=> $jsonData["type"],"subtype"=>$type, "data" => $jsonData["data"]);
                unlink($path.'/'.$file);
            }
        }
        return $messages;
    }

}

?>