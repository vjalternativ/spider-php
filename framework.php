<?php 
global $vjlib,$vjconfig,$seoParams;

class SpiderPhpFramework {
    
    
    public $configpath;
    public $backendMode = false;
    public $sessionName = "ATVPHPSESSID";
    
    function initSession() {
        
        
        if($this->backendMode) {
            $this->sessionName .= "_CA";
        }
        session_name($this->sessionName);
        ini_set('session.gc_maxlifetime', 28800);
        session_set_cookie_params(28800);
        session_start();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        ini_set("memory_limit",-1);
        set_time_limit(0);
        error_reporting(E_ALL);
        
    }
    
    function calculateconfigPath() {
        $newdir = $_SERVER['SCRIPT_FILENAME'];
        $this->configpath = substr($newdir, 0,strrpos($newdir,"/"));;
        $idir = __DIR__;
        $dir  = substr($this->configpath,0,strrpos($this->configpath,"/"));
        if(file_exists($dir.'/'.'config.php')) {
            $this->configpath = $dir;
        }
        
    }
    
    function __construct($backendMode = false,$sessName =false) {
        $this->backendMode = $backendMode;
        if($sessName) {
            $this->sessionName = $sessName;
        }
        
        $this->initSession();
        $this->calculateconfigPath();
    }
    
    function setConfigPath($path) {
        $this->configpath = $path;
    }
    
    function execute() {
        global $vjlib,$vjconfig,$seoParams;
        $vjfwpath = __DIR__;
        $dir = __DIR__;
        $dir .= "/";
        require_once $this->configpath.'/config.php';
        require_once $this->configpath.'/seoconfig.php';
        $vjconfig['basepath'] = $this->configpath.'/';
        if(isset($vjconfig['display_errors'])) {
            ini_set("display_errors",$vjconfig['display_errors']);
        } else {
            ini_set("display_errors",false);
        }
        if($this->backendMode) {
            unset($vjconfig['framework']['default_mode']);
        } else {
            require_once $dir.'seomanager.php';
        }
        $vjconfig['fwbasepath'] = $vjfwpath."/";
        
        
        if(!isset($vjconfig['fwbaseurl'])) {
            $vjconfig['fwbaseurl'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'],"",$dir);
        }
        
        $vjconfig['urlbasepath'] = str_replace('://', "", $vjconfig['baseurl']);
        $vjconfig['urlbasepath'] = substr($vjconfig['urlbasepath'],strpos($vjconfig['urlbasepath'], "/"));
        $vjconfig['fwurlbasepath'] = str_replace('://', "", $vjconfig['fwbaseurl']);
        $vjconfig['fwurlbasepath'] = substr($vjconfig['fwurlbasepath'],strpos($vjconfig['fwurlbasepath'], "/"));
        
        date_default_timezone_set($vjconfig['timezone']);
        require_once $vjconfig['fwbasepath'].'include/vjlib/VJLib.php';
        require_once $vjconfig['fwbasepath'].'include/Smarty/Smarty.class.php';
        
        $vjlib = new VJLib();
        $vjlib->loadlibs(array("Entity","BootStrap","MysqliLib","Paginate","Logger"));
        $vjlib->getobj("VJFramework");
    }
}
?>