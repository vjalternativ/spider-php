<?php 
class Logger {
    public $type = "INFO";
    
    function fatal($log) {
        $type = "FATAL";
        $this->log($log);
    }
    
    function info($log) {
        $type = "INFO";
        $this->log($log);
    }
    
    function debuug($log) {
        $type = "DEBUG";
        $this->log($log);
    }
    
    function warning($log) {
        $type = "WARNING";
        $this->log($log);
    }
    
   function log($log) {
        error_log(date("Y-m-d H:i:s")." : ".$this->type." : ".$log."\n",3,"framework.log");
        
    }
    
    function doLog($type,$log,$path) {
        error_log(date("Y-m-d H:i:s")." : ".$type." : ".$log."\n",3,$path);
    }
    
    function justlog($log,$path) {
        error_log($log."\n",3,$path);
        
    }
}
?>