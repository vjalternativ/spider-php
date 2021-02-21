<?php
class lib_logger {
    private $logFile;
    private $threadId=false;
    private static $instance = null;
    private static $fileVsLogger =array();

    function __construct($logfile=false) {
            $this->logFile = $logfile ? $logfile : "logger.log";
            $this->threadId = uniqid();
    }

    static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new lib_logger();
        }
        return self::$instance;
    }


    private static function as(lib_logger $logger) {
        return $logger;
    }
    static function getLogger($file) {
        if(!isset(self::$fileVsLogger[$file])) {
            self::$fileVsLogger[$file] = new lib_logger($file);
        }
        return self::as(self::$fileVsLogger[$file]);
    }

    private function log($type,$message) {
        $date = date("Y-m-d");
        $logmessage = date("Y-m-d H:i:s").' : ';
        if($this->threadId) {
            $logmessage .= $this->threadId." ";
        }
        $logmessage .= $type.' : '.$message.PHP_EOL;
        $dir = lib_config::getInstance()->get("storage_basepath");
        $dir = $dir ?  $dir : lib_config::getInstance()->get("basepath");
        $path = $dir."logs/".$date.'/';
        if(!is_dir($path)) {
            $cmd ='mkdir -p '.$path;
            shell_exec($cmd);
        }
        $path .= $this->logFile;
        if(php_sapi_name() == "cli") {
            echo $logmessage.PHP_EOL;
        }
        error_log($logmessage,3,$path);
    }

    function error($message) {
        $this->log("ERROR",$message);
    }
    function warn($message) {
        $this->log("WARN",$message);
    }
    function debug($message) {
        $this->log("DEBUG",$message);
    }
    function info($message) {
        $this->log("INFO",$message);
    }

    function fatal($message) {
        $this->log("ERROR",$message);
    }


}
?>