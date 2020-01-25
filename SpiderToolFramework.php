<?php
global $cliargs;
$cliargs = false;
if($argv) {
    $cliargs = $argv;
}

require_once __DIR__.'/framework.php';

class SpiderToolFramework extends SpiderPhpFramework
{
    function __construct($sessionName=false) {
        $_REQUEST['spiderphp_mode'] = 'TOOL';
        
        global $cronconfig;
        
        
        
        
        parent::__construct($sessionName);
        
    }
    
    function executeActionTypePageController() {
        
    }
    function executeActionTypePageView($pagename,$argv) {
        global $vjconfig;
        $pagepath = $vjconfig['basepath'].'include/entrypoints/site/pages/'.$pagename;
        if(is_dir($pagepath)) {
            $viewtplpath = $pagepath."/".'views/'.$vjconfig['sitetpl']."/";
            $cmd  = "mkdir -p ".$viewtplpath;
            shell_exec($cmd);
            $string = file_get_contents($vjconfig['fwbasepath'].'include/vjlib/templates/page/tplpageview.php');
            if(isset($argv[5])) {
                $viewname = $argv[5];
                $string = str_replace("__PAGENAME__", $pagename, $string);
                $string = str_replace("__VIEWNAME__", $viewname, $string);
                file_put_contents($viewtplpath.'view.'.$viewname.'.php', $string);
                $tplpath = $pagepath."/tpls/".$vjconfig['sitetpl']."/";
                $cmd  = "mkdir -p ".$tplpath;
                shell_exec($cmd);
                file_put_contents($tplpath.$viewname.".tpl", "");
                
            
            } else {
                echo "specify action type view | viewname";
            }
        } else {
            die("directory not exist ".$pagepath);
        }
        
    }
    
    function executeActionTypePage($tpl,$argv) {
        if ($tpl == "controller") {
                
        } else if ($tpl == "view") {
            if(isset($argv[4])) {
                $this->executeActionTypePageView($argv[4],$argv);
            } else {
                echo "specify action type page view pagename";    
            }
        } else {
             echo "specify correct page action type : controller  or view";
        }
    }
    
    function executeActionCreate($actionType,$argv) {
        if ($actionType == "page") {
            if(isset($argv[3])) {
                $this->executeActionTypePage($argv[3],$argv);
            } else {
                echo "specify action type page template| controller or view";
           }
        } else if ($actionType == "module") {
                
        } else {
                echo "specify correct create type : page module";
        }
    }

    function exxecuteAction($action,$argv) {
            if ($action == "create") {
                if(isset($argv[2])) {
                    $this->executeActionCreate($argv[2], $argv);
                } else {
                    echo "specify create type : page module";
                }
            } else {
                echo "specifiy correct action : create update delete";
            }
    }

    function execute()
    {
        global $cliargs, $cronconfig, $vjconfig;
        
        require_once $this->configpath.'/cronconfig.php';
        if(isset($cronconfig[$this->configpath])) {
            $_SERVER['HTTP_HOST'] = $cronconfig[$this->configpath]['host'];
        }
        require_once $this->configpath.'/config.php';
        
        $vjconfig['basepath'] = $this->configpath."/";
        $vjconfig['fwbasepath'] = __DIR__."/";
        
        $argv = $cliargs;
        if ($argv) {
            if (isset($argv[1])) {
                $this->exxecuteAction($argv[1],$argv);
            } else {
                echo "specifiy action : create update delete";
            }
        } else {
            echo "specifiy action : create update delete";
        }
        
        echo PHP_EOL;
        
    }
}

?>