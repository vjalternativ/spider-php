<?php
class lib_config {
    private static $instance = null;
    private $config;

    function __construct() {
        $dir = __DIR__;
        $fwbasepath = substr($dir,0,strrpos($dir,"/"))."/";
        if(isset($_SERVER['argv'])) {
            if(substr($_SERVER['SCRIPT_FILENAME'],0,1)=="/") {
                $dir = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],"/")).'/';
            } else {
                $path = $_SERVER['PWD']  .'/'. $_SERVER['SCRIPT_FILENAME'];
                $dir = substr($path,0,strrpos($path,"/")).'/';
            }
        } else if(isset($_SERVER['SCRIPT_FILENAME'])){
            $dir = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],"/")).'/';
        }


        global $config;
        try {
        require_once $dir.'config.php';
        } catch(Exception $e) {
            lib_logger::getInstance()->error(print_r(debug_backtrace(),1));
        }
        $this->config = $config;
        $this->config['display_errors'] = $this->config['display_errors'] ? $this->config['display_errors'] : false;
        ini_set("display_errors",$this->config['display_errors']);
        $this->config['fwbasepath'] = $fwbasepath;
        $this->config['basepath'] = $dir;
        $this->config['resource_alias']['backend'] = isset($this->config['resource_alias']['backend']) ? $this->config['resource_alias']['backend'] : 'backend';

    }




    static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new lib_config();
        }
        return self::$instance;
    }

    function get($key) {
        return isset($this->config[$key]) ? $this->config[$key] : false;
    }

    function getConfig() {
        return $this->config;
    }


}
?>