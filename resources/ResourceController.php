<?php
class ResourceController {



    protected $resource;
    protected $module;
    protected $action;
    protected $params = array();
    private $lock = null;

    function __construct() {
        $reflector = new \ReflectionObject($this);
        $str = $reflector->getFileName();
        $str = str_replace("modules/","",$str);
        $str = substr($str,0,strrpos($str,"/"));
        $this->module = substr($str,(strrpos($str,"/")+1));
        $str = substr($str,0,strrpos($str,"/"));
        $this->resource = substr($str,(strrpos($str,"/")+1));

        $action = $_GET['action'];
        if(!method_exists($this, "action_".$action)) {
            $action = "index";
        }
        $this->action = $action;
    }



    protected function getRealPath($dir,$isFile=false) {
        $libConfig = lib_config::getInstance();
        $path = $libConfig->get("basepath").$dir;
        $fwpath= $libConfig->get("fwbasepath").$dir;
        if($isFile) {
            if(file_exists($path)) {
                return $path;
            } else if(file_exists($fwpath)) {
                return $fwpath;
            }
        } else {
            if(is_dir($path)) {
                return $path;
            } else if(is_dir($fwpath)) {
                return $fwpath;
            }
        }

        return false;
    }

    function rendorTpl($tpl, $params = array(),$sitetpl=false,$module=false)
    {
        $smarty =  lib_smarty::getSmartyInstance();
        $vjconfig= lib_config::getInstance()->getConfig();



        $params =$this->params ? array_merge($params, $this->params) : $params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $smarty->assign("urlbasepath", $vjconfig['urlbasepath']);
        $siteTpl = $sitetpl ? $sitetpl : $vjconfig['sitetpl'];

        $mod = $module? $module : $this->module;
        $this->params['controller_path'] = $this->getRealPath('resources/'.$this->resource.'/modules/' . $mod . '/');

        if($this->params['controller_path']) {

            $tplPath = 'resources/'.$this->resource.'/modules/' . $mod . '/'. 'tpls/' ;
            $this->params['controller_tpl_path'] = $this->getRealPath($tplPath. $siteTpl . '/');
            if(!$this->params['controller_tpl_path']) {
                $this->params['controller_tpl_path'] = $this->getRealPath($tplPath . 'default/');
            }
            if(!$this->params['controller_tpl_path']) {
                $this->params['controller_tpl_path'] = $this->params['controller_path'];
            }
            if($this->params['controller_tpl_path']) {
                return $smarty->fetch($this->params['controller_tpl_path'] . $tpl);
            }
        } else {
            echo "controller path not found";
            throw new \Exception("tpl not configured ".$tpl);

        }




    }

    function getResource() {
        return $this->resource;
    }
    function getModule() {
        return $this->module;
    }

    function getParams() {
        return $this->params;
    }


    function lockRequest($file) {
        $lockfile = lib_config::getInstance()->get("basepath").'locks/pullnotification.lock';


        $this->lock = fopen ( $lockfile, 'w' );
        if ($this->lock === false) {
            $this->sendResponse(501, "Unable to create lock file" );
        }

        if (! flock ( $this->lock, LOCK_EX | LOCK_NB )) {
            $this->sendResponse(501, "Lock already in use by another process\n" );
        }
    }

    function sendResponse($responseCode,$payload=null) {

        $result = array("status"=>"failed","data"=>$payload);
        if($responseCode==200) {
               $result['status'] = "success";
        } else if($responseCode >=400 && $responseCode < 500) {
            $result['status'] = "warning";
        } else if($responseCode >=500 && $responseCode < 600) {
            $result['status'] = "danger";
        }

        echo json_encode($result);

        if($this->lock) {
            fclose ( $this->lock );
        }
        exit();

    }

    function sendJSONResponse($responseCode,$data=array()) {
         echo json_encode($data);
    }

    protected function validateFormFields($fields, $data)
    {
        $isValid = true;
        foreach ($fields as $field => $label) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);
                if ($data[$field]) {
                    continue;
                } else {
                    $isValid = false;
                    $this->setResponse("warning", "Field " . $label . " is mandatory.");
                    break;
                }
            } else {
                $isValid = false;
                $this->setResponse("warning", "Field " . $label . " is not set.");
                break;
            }
        }

        if ($isValid) {
            return $data;
        }
        return false;
    }

    protected function validateSession()
    {
        $isAuthorized =  lib_current_user::sessionCheck();
        if (! $isAuthorized) {
            die("access denied.");
        }
    }
}
?>