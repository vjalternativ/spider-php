<?php
class notificationService {

    private static $instance = null;


    static function getInstance()  {
        if(self::$instance==null) {
            self::$instance = new notificationService();
        }
        return self::$instance;
    }


    public function registerNotificationPath($type,$relativepath) {
        $cmd = "mkdir -p ".lib_config::getInstance()->get("basepath").'cache/notifications/'.$relativepath;
        shell_exec($cmd);
        $_SESSION['notification_path'][$type] = $relativepath;
    }


    function broadcastMessage($relativepath,$id,$message=array()) {
        $path = lib_config::getInstance("basepath").'cache/notifications/'.$relativepath;
        $files = scandir($path);
        if($files) {
            unset($files[0]);
            unset($files[1]);
            $msgId =uniqid();
            foreach($files as $directory) {
                $participantPath = $path.'/'.$directory.'/';
                if(is_dir($participantPath) && $directory !=$id) {
                    file_put_contents($participantPath.$msgId, json_encode($message));
                }
            }
        }
    }

    private function getNotificationPaths() {
        return isset($_SESSION['notification_path']) ? array_keys($_SESSION['notification_path']) : array();
    }

    public function fetchMessages() {
        $notificationPaths = $this->getNotificationPaths();
        $messages  =array();
        foreach($notificationPaths as $type => $path) {
            $path = lib_config::getInstance()->get("basepath").'cache/notifications/'.$path;
            $files = scandir($path);
            unset($files[0]);
            unset($files[1]);
            foreach($files as $file){
                $messages[$type][] = file_get_contents($path.'/'.$file);
                unlink($path.'/'.$file);
            }
        }
        return $messages;
    }

}

?>