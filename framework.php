<?php 
global $vjlib,$vjconfig,$seoParams;

class SpiderPhpFramework {
    
    
    public $configpath;
    public $sessionName = "ATVSESS";
    public $frameworkMode = "FRONTEND";
    function initSession() {
        
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
        $dir  = substr($this->configpath,0,strrpos($this->configpath,"/"));
        if(file_exists($dir.'/'.'config.php')) {
            $this->configpath = $dir;
        } else {
            if(isset($_SERVER['argv'][0])) {
                $files = get_included_files();
                $this->configpath = dirname($files[0]);
            }
        }
        
    }
    
    function __construct($sessionName=false) {
        
        if(isset($_REQUEST['spiderphp_mode'])) {
            $this->frameworkMode = $_REQUEST['spiderphp_mode'];
        }
        if($sessionName) {
            $this->sessionName = $sessionName;
        } else {
            $this->sessionName .= '_'.$this->frameworkMode;
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
        set_include_path($this->configpath);
        
        $vjconfig['fw_mode'] = $this->frameworkMode;
        
        if(isset($vjconfig['display_errors'])) {
            ini_set("display_errors",$vjconfig['display_errors']);
        } else {
            ini_set("display_errors",false);
        }
        
        require_once $this->configpath.'/seoconfig.php';
        $vjconfig['basepath'] = $this->configpath.'/';
        
        if($this->frameworkMode == "FRONTEND" ) {
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