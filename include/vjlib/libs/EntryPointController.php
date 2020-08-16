<?php
global $vjconfig;
require_once $vjconfig['fwbasepath'] . 'include/vjlib/abstract/AWidget.php';

class EntryPointController
{

    public $params = array();

    public $view = "";

    public $bootparams = array();

    public $headerparams = array();

    public $footerparams = array();

    public $redirectView = false;

    public $routes = array();

    public $page = "";

    public $method = "";

    public $authFunctions = array();

    public $response = array(
        'status' => "danger",
        'message' => "Something went wrong."
    );

    function __construct()
    {
        global $vjconfig;
        $class = get_called_class();
        $class = str_replace("Controller", "", $class);

        $this->bootparams['controller_path'] = 'include/entrypoints/site/pages/' . $class . '/';
        $this->bootparams['controller_tpl_path'] = 'include/entrypoints/site/pages/' . $class . '/tpls/' . $vjconfig['sitetpl'] . '/';
        $this->bootparams['current_url'] = $_SERVER['REQUEST_URI'];
    }

    function displayView($view)
    {
        global $vjconfig;

        $class = get_class($this);
        $class = str_replace("Controller", "", $class);

        require_once $vjconfig['fwbasepath'] . 'include/views/EntryPointView.php';
        require_once "include/entrypoints/site/pages/" . $class . "/views/view." . $view . ".php";
        $viewClass = $class . "View" . ucfirst($view);
        $viewOb = new $viewClass();
        $viewOb->pagetplpath = $vjconfig['basepath'] . 'include/entrypoints/site/pages/' . $class . '/tpls/' . $vjconfig['sitetpl'] . '/';
        $viewOb->loadHeader();
        $viewOb->display();
    }

    function redirectView($page, $method)
    {
        $this->redirectView['page'] = $page;
        $this->redirectView['method'] = 'action_' . $method;
    }

    function rendorTpl($tpl, $params = array(),$sitetpl=false)
    {
        global $smarty, $vjconfig;

        $params += $this->params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $class = get_called_class();
        $class = str_replace("Controller", "", $class);
        $siteTpl = $sitetpl ? $sitetpl : $vjconfig['sitetpl'];
        $this->bootparams['controller_path'] = 'include/entrypoints/site/pages/' . $class . '/';
        $this->bootparams['controller_tpl_path'] = 'include/entrypoints/site/pages/' . $class . '/tpls/' . $siteTpl . '/';

        return $smarty->fetch($this->bootparams['controller_tpl_path'] . $tpl);
    }

    function registerBreadcrumb($id, $title, $alias, $params = array())
    {
        $dataWrapper = DataWrapper::getInstance();
        $breadcrumb = $dataWrapper->get("breadcrumb");
        $breadcrumb[$id]['title'] = $title;
        $breadcrumb[$id]['alias'] = $alias;
        $breadcrumb[$id]['params'] = $params;
        $dataWrapper->set("breadcrumb", $breadcrumb);
    }

    function getBreadcrumb()
    {
        return DataWrapper::getInstance()->get("breadcrumb");
    }

    function action_index()
    {
        $this->registerBreadcrumb("home", "Home", "");
    }

    function rendorPageTpl($page, $tpl, $params = array())
    {
        global $smarty, $vjconfig;

        $params += $this->params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $class = $page;

        $this->bootparams['controller_path'] = 'include/entrypoints/site/pages/' . $class . '/';
        $this->bootparams['controller_tpl_path'] = 'include/entrypoints/site/pages/' . $class . '/tpls/' . $vjconfig['sitetpl'] . '/';

        return $smarty->fetch($this->bootparams['controller_tpl_path'] . $tpl);
    }

    function rendorSiteTpl($tpl, $params = array(), $site = false)
    {
        global $smarty, $vjconfig;
        $params += $this->params;
        $smarty->assign("params", $params);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $sitetpl = $site ? $site : $vjconfig['sitetpl'];

        return $smarty->fetch("include/entrypoints/site/tpls/" . $sitetpl . "/" . $tpl);
    }

    function setResponse($status, $message)
    {
        $this->response['status'] = $status;
        $this->response['message'] = $message;
    }

    function registerAuthFunction($funcName)
    {
        $this->authFunctions[$funcName] = $funcName;
    }

    protected function validateSession()
    {
        $isAuthorized = sessioncheck("current_user");
        if (! $isAuthorized) {
            die("access denied.");
        }
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
}

?>