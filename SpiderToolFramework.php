<?php
global $cliargs;
$cliargs = false;
if ($argv) {
    $cliargs = $argv;
}

require_once __DIR__ . '/framework.php';

class SpiderToolFramework extends SpiderPhpFramework
{

    var $cliRegistrar = array();

    function __construct($sessionName = false)
    {
        $_REQUEST['spiderphp_mode'] = 'TOOL';


        parent::__construct($sessionName);

        $this->cliRegistrar['create'] = array();
        $this->cliRegistrar['create']['page']['controller'] = "createPageController,page_name";
        $this->cliRegistrar['create']['page']['view'] = "createPageView,page_name,view_name";
        $this->cliRegistrar['create']['widget'] = "createWidget,widget_name";
        $this->cliRegistrar['create']['module']['logichook'] = "createModuleLogichook,module_name";
    }
    
    
    function _getFWTemplateFileContents($path) {
        global $vjconfig;
        return file_get_contents($vjconfig['fwbasepath'].'include/vjlib/templates/'.$path);
        
    }
    
    
    function _replaceContent($relativeTemplatePath,$targetPath,$keyvalue) {
        
        
        if(file_exists($targetPath)) {
            echo $targetPath." already existing. skipping..".PHP_EOL;
        } else {
            
            $content = $this->_getFWTemplateFileContents($relativeTemplatePath);
            foreach($keyvalue as $key=>$value) {
                $content = str_replace($key,$value,$content);
            }
            
            
            file_put_contents($targetPath, $content);
            echo $targetPath." ".PHP_EOL;
            
        }
        
        
    }
    
    function createModuleLogichook($params) {
        
        global $vjconfig;
        $name = $params['module_name'];
        
        $modulepath = $vjconfig['basepath'].'custom/modules/'.$name.'/';
        $hookpath = $modulepath.'/hooks/';
        
        $command = "mkdir -p ".$hookpath;
        shell_exec($command);
        
        $keyvalue =array("__MODULENAME__" => $name);
        $this->_replaceContent('module/hooks/moduleLogicHook.php', $hookpath.$name.'LogicHook.php', $keyvalue);
        $this->_replaceContent('module/logic_hooks.php', $modulepath.'logic_hooks.php', $keyvalue);
        
    }
    
    function createPageController($params) {
        global $vjconfig;
        $name = $params['page_name'];
        $controllerPath = $vjconfig['basepath'] . 'include/entrypoints/site/pages/'.$name.'/';
        $cmd = "mkdir -p " . $controllerPath;
        shell_exec($cmd);
        $content = file_get_contents($vjconfig['fwbasepath'].'include/vjlib/templates/page/tplpagecontroller.php');
        $content = str_replace("__PAGENAME__",$name,$content);
        file_put_contents($controllerPath.$name."Controller.php", $content);
        
        
    }
    
    function createWidget($params) {
        global $vjconfig;
        
        $widgetName = $params['widget_name'];
        $widgetPath = $vjconfig['basepath'] . 'include/entrypoints/site/widgets/' .$vjconfig['sitetpl']. '/'.$widgetName.'/';
        $cmd = "mkdir -p " . $widgetPath;
        shell_exec($cmd);
        
        $cmd = "cp -r ".$vjconfig['fwbasepath'].'include/vjlib/templates/frontend/samplewidget/* '.$widgetPath;
        shell_exec($cmd);
        
        $packagejson = $widgetPath."package.json";
        $packagejsonContent = file_get_contents($packagejson);
        $packagejsonContent = str_replace("__WIDGET_NAME__", $widgetName, $packagejsonContent);
        file_put_contents($packagejson, $packagejsonContent);
        
        $widgetController = $widgetPath."sampleWidget.php";
        $widgetControllerContent = file_get_contents($widgetController);
        $widgetControllerContent = str_replace("__WIDGET_NAME__", $widgetName, $widgetControllerContent);
        file_put_contents($widgetController, $widgetControllerContent);
        
        $cmd = 'mv '.$widgetController.' '.$widgetPath.$widgetName.'Widget.php';
        shell_exec($cmd);
        $widgetTpl = $widgetPath."sampleWidget.tpl";
        $cmd = 'mv '.$widgetTpl.' '.$widgetPath.$widgetName.'Widget.tpl';
        shell_exec($cmd);
        
        
    }

    function createPageView($params)
    {
        global $vjconfig;
        $pagename = $params['page_name'];
        $pagepath = $vjconfig['basepath'] . 'include/entrypoints/site/pages/' . $pagename;
        $viewtplpath = $pagepath . "/" . 'views/';
        $cmd = "mkdir -p " . $viewtplpath;
        shell_exec($cmd);
        
        $viewname = $params['view_name'];
        $keyvalue = array("__PAGENAME__"=>$pagename,"__VIEWNAME__"=>ucfirst($viewname));
        
        
        $this->_replaceContent("page/tplpageview.php", $viewtplpath . 'view.' . $viewname . '.php', $keyvalue);
        
        $tplpath = $pagepath . "/tpls/" . $vjconfig['sitetpl'] . "/";
        $cmd = "mkdir -p " . $tplpath;
        shell_exec($cmd);
        
        if(!file_exists($tplpath . $viewname . ".tpl")) {
            file_put_contents($tplpath . $viewname . ".tpl", "");
        }
         
    }

    function processArgs($index, $args, $registrar)
    {
        if (isset($args[$index])) {

            if (isset($registrar[$args[$index]])) {

                if (is_array($registrar[$args[$index]])) {
                    $newIndex = $index + 1;
                    $this->processArgs($newIndex, $args, $registrar[$args[$index]]);
                } else {
                    if ($registrar[$args[$index]]) {

                        $options = explode(",", $registrar[$args[$index]]);

                        $method = $options[0];
                        unset($options[0]);

                        $params = array();

                        $isValid = true;
                        $parg = "";
                        foreach ($options as $op) {
                            $index ++;
                            if (isset($args[$index])) {
                                $params[$op] = $args[$index];
                            } else {
                                $isValid = false;
                                $parg = $op;
                                break;
                            }
                        }
                        if ($isValid) {
                            if (method_exists($this, $method)) {
                                $this->{$method}($params);
                            } else {
                                echo $method . " function not defined in class." . PHP_EOL;
                            }
                        } else {
                            echo "specify " . $parg . " in arguments" . PHP_EOL;
                        }
                    } else {
                        echo "option not defined" . PHP_EOL;
                    }
                }
            } else {

                $keys = array_keys($registrar);
                $string = implode("/", $keys);
                echo "Invalid input. Options are =>  " . $string . PHP_EOL;
            }
        } else {
            $keys = array_keys($registrar);
            $string = implode("/", $keys);
            echo "Invalid input. Options are =>  " . $string . PHP_EOL;
        }
    }

    function execute()
    {
        global $cliargs, $cronconfig, $vjconfig;

        require_once $this->configpath . '/cronconfig.php';
        if (isset($cronconfig[$this->configpath])) {
            $_SERVER['HTTP_HOST'] = $cronconfig[$this->configpath]['host'];
        }
        require_once $this->configpath . '/config.php';

        $vjconfig['basepath'] = $this->configpath . "/";
        $vjconfig['fwbasepath'] = __DIR__ . "/";

        $argv = $cliargs;

        $this->processArgs(1, $argv, $this->cliRegistrar);
        echo "Job done.".PHP_EOL;
    }
}

?>