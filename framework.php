<?php 
session_name('ATVPHPSESSID');
ini_set('session.gc_maxlifetime', 28800);
session_set_cookie_params(28800);
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
ini_set("memory_limit",-1);
set_time_limit(0);
error_reporting(E_ALL);
global $vjlib,$vjconfig,$seoParams;

class SpiderPhpFramework {
    
    
    public $configpath;
    function __construct() {
        $idir = __DIR__;
        $dir = substr($idir,0,strrpos($idir,"/"));
        $newdir = $_SERVER['SCRIPT_FILENAME'];
        $newdir = str_replace($dir.'/', "", $newdir);
        $newdir = substr($newdir, 0,strpos($newdir,"/"));
        //if path is same as framework then
        if(substr($idir,strrpos($idir,"/"))=='/'.$newdir) {
            if(file_exists($dir.'/'.'config.php')) {
                $this->configpath = $dir;
            }
        } else {
            //no symlink is same
            if($newdir) {
                $this->configpath = $dir."/".$newdir;
            } else {
                $this->configpath = $dir;
            }
        }
        
    }
    
    
    function setConfigPath($path) {
        $this->configpath = $path;
        //set_include_path($path);
    }
    
    function execute($backendMode = false) {
        global $vjlib,$vjconfig,$seoParams;
        $vjfwpath = __DIR__;
        
        $dir = __DIR__;
        $dir .= "/";
        
        require_once $this->configpath.'/config.php';
        require_once $this->configpath.'/extraconfig.php';
        require_once $this->configpath.'/seoconfig.php';
        $vjconfig['basepath'] = $this->configpath.'/';
        if(isset($vjconfig['display_errors'])) {
            ini_set("display_errors",$vjconfig['display_errors']);
        } else {
            ini_set("display_errors",false);
            
        }
        if($backendMode) {
            unset($vjconfig['framework']['default_mode']);
        } else {
            require_once $dir.'seomanager.php';
            
        }
        $vjconfig['fwbasepath'] = $vjfwpath."/";
        
        
        $vjconfig['fwbaseurl'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'],"",$dir);
        $fwurlbasepath = str_replace($_SERVER['DOCUMENT_ROOT'],"",$dir);
        if(!isset($vjconfig['fwurlbasepath'])) {
            $vjconfig['fwurlbasepath'] = $fwurlbasepath;
        }
        date_default_timezone_set($vjconfig['timezone']);
        require_once $vjconfig['fwbasepath'].'include/vjlib/VJLib.php';
        require_once $vjconfig['fwbasepath'].'include/Smarty/Smarty.class.php';
        
        $vjlib = new VJLib();
        $vjlib->loadlibs(array("Entity","BootStrap","MysqliLib","Paginate","Logger"));
        $vjlib->getobj("VJFramework");
    }
}
?>