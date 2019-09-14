<?php 
session_name('ATVPHPSESSID');
ini_set('session.gc_maxlifetime', 28800);
session_set_cookie_params(28800);
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
ini_set("memory_limit",-1);
set_time_limit(0);
ini_set("display_errors",1);
error_reporting(E_ALL);
global $vjlib,$vjconfig,$seoParams;

class SpiderPhpFramework {
    
    
    public $configpath;
    
    
    function setConfigPath($path) {
        $this->configpath = $path;
    }
    
    function execute($backendMode = false) {
        global $vjlib,$vjconfig,$seoParams;
        $vjfwpath = __DIR__;
        
        $strarray = explode("/",$vjfwpath);
        $fwfolder = end($strarray);
        $dir = __DIR__;
        $dir .= "/";
        
        //error_reporting(0);
       // set_include_path(__DIR__);
        require_once $this->configpath.'/config.php';
        require_once $this->configpath.'/extraconfig.php';
        require_once $this->configpath.'/seoconfig.php';
        $vjconfig['basepath'] = $this->configpath.'/';
        
        if($backendMode) {
            unset($vjconfig['framework']['default_mode']);
        } else {
            require_once $dir.'seomanager.php';
            
        }
        $vjconfig['fwbasepath'] = $vjfwpath."/";
        $strarray = explode("/",$vjconfig['baseurl']);
        
        array_pop($strarray);
        
        if($fwfolder==end($strarray)) {
            $vjconfig['fwbaseurl'] = $vjconfig['baseurl'];
        } else {
            $vjconfig['fwbaseurl'] = $vjconfig['baseurl'].$fwfolder."/";
            
        }
        
        date_default_timezone_set($vjconfig['timezone']);
        require_once $dir.'include/vjlib/VJLib.php';
        require_once $dir.'include/Smarty/Smarty.class.php';
        
        $vjlib = new VJLib();
        $vjlib->loadlibs(array("Entity","BootStrap","MysqliLib","Paginate","Logger"));
        $vjlib->getobj("VJFramework");
    }
}
?>