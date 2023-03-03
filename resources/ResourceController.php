<?php

class ResourceController
{

    protected $resource;

    protected $module;

    protected $action;

    protected $params = array();

    private $lock = null;

    private $controllerDirectoyPath = "";

    function __construct()
    {
        $reflector = new \ReflectionObject($this);
        $filepath = $reflector->getFileName();

        $arr = explode("resources/", $filepath);

        $str = $arr[1];

        $arr = explode("/", $str);

        $this->resource = $arr[0];

        $this->module = isset($arr[2]) ? $arr[2] : $_REQUEST['module'];

        $action = $_GET['action'];
        if (! method_exists($this, "action_" . $action)) {
            $action = "index";
        }
        $this->controllerDirectoyPath = substr($filepath, 0, strrpos($filepath, "/")) . '/';
        $this->action = $action;
    }

    public function getControllerDirectoryPath()
    {
        return $this->controllerDirectoyPath;
    }

    protected function getRealPath($dir, $isFile = false)
    {
        $libConfig = lib_config::getInstance();
        $path = $libConfig->get("basepath") . $dir;
        $fwpath = $libConfig->get("fwbasepath") . $dir;
        if ($isFile) {
            if (file_exists($path)) {
                return $path;
            } else if (file_exists($fwpath)) {
                return $fwpath;
            }
        } else {
            if (is_dir($path)) {
                return $path;
            } else if (is_dir($fwpath)) {
                return $fwpath;
            }
        }

        return false;
    }

    function rendorTpl($tpl, $params = array(), $sitetpl = false, $module = false)
    {
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $params = $this->params ? array_merge($params, $this->params) : $params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $smarty->assign("urlbasepath", $vjconfig['urlbasepath']);
        $siteTpl = $sitetpl ? $sitetpl : $vjconfig['sitetpl'];

        $mod = $module ? $module : $this->module;
        $this->params['controller_path'] = $this->getRealPath('resources/' . $this->resource . '/modules/' . $mod . '/');

        if ($this->params['controller_path']) {

            $tplPath = 'resources/' . $this->resource . '/modules/' . $mod . '/' . 'tpls/';
            $this->params['controller_tpl_path'] = $this->getRealPath($tplPath . $siteTpl . '/');
            if (! $this->params['controller_tpl_path']) {
                $this->params['controller_tpl_path'] = $this->getRealPath($tplPath . 'default/');
            }
            if (! $this->params['controller_tpl_path']) {
                $this->params['controller_tpl_path'] = $this->params['controller_path'];
            }
            if ($this->params['controller_tpl_path']) {
                $html = $smarty->fetch($this->params['controller_tpl_path'] . $tpl);
                $dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($html);
                libxml_clear_errors();

                $out = '';
                foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $child) {
                    $out .= $dom->saveXML($child);
                }
                return $out;
            }
        } else {
            echo "controller path not found " . 'resources/' . $this->resource . '/modules/' . $mod . '/';
            throw new \Exception("tpl not configured " . $tpl);
        }
    }

    function getResource()
    {
        return $this->resource;
    }

    function getModule()
    {
        return $this->module;
    }

    function getParams()
    {
        return $this->params;
    }

    function lockRequest($file)
    {
        $lockfile = lib_config::getInstance()->get("basepath") . 'locks/pullnotification.lock';

        $this->lock = fopen($lockfile, 'w');
        if ($this->lock === false) {
            $this->sendResponse(501, "Unable to create lock file");
        }

        if (! flock($this->lock, LOCK_EX | LOCK_NB)) {
            $this->sendResponse(501, "Lock already in use by another process\n");
        }
    }

    function sendResponse($responseCode, $payload = null)
    {
        $result = array(
            "status" => "failed",
            "data" => $payload
        );
        if ($responseCode == 200) {
            $result['status'] = "success";
        } else if ($responseCode >= 400 && $responseCode < 500) {
            $result['status'] = "warning";
        } else if ($responseCode >= 500 && $responseCode < 600) {
            $result['status'] = "danger";
        }

        echo json_encode($result);

        if ($this->lock) {
            fclose($this->lock);
        }
        exit();
    }

    function sendJSONResponse($responseCode, $data = array())
    {
        echo json_encode($data);
    }

    protected function validateFormFields($fields, $data)
    {
        $isValid = true;
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);
                if ($data[$field]) {
                    continue;
                } else {
                    $isValid = false;
                    break;
                }
            } else {
                $isValid = false;
                break;
            }
        }

        if ($isValid) {
            return $data;
        }
        return false;
    }

    protected function validateSession($resource = "default")
    {
        $isAuthorized = lib_current_user::sessionCheck();
        if (! $isAuthorized) {
            die("access denied.");
        }
    }

    protected function validateRoleAndSession($roleName, $resource = "default")
    {
        $this->validateSession($resource);
        $user = lib_current_user::getEntityInstance($resource);
        if ($user->role_name != $roleName) {
            die("access denined");
        }
    }

    function redirect($url)
    {
        header('location:' . lib_config::getInstance()->get("baseurl") . $url);
    }
}
?>