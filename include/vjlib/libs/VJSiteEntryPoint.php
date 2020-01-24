<?php

class VJSiteEntryPoint
{

    public $page = "home";
    public $method = "action_index";
    public $sitebasePath = "";
    public $view;
    public $bootparams = array();
    private $footerparams = array();
    private $headerparams = array();

    function __construct()
    {
        global $vjconfig, $seoParams, $db;

        $this->sitebasePath = $vjconfig['basepath'] . 'include/entrypoints/' . $_REQUEST['entryPoint'];
        if (isset($_REQUEST['page'])) {
            $this->page = $_REQUEST['page'];
        }
        if (isset($seoParams[0]) && empty($seoParams[0])) {
            $seoParams[0] = $this->page;
        }
        if (isset($seoParams[0]) && (file_exists($this->sitebasePath . '/pages/' . $seoParams[0] . '/' . $seoParams[0] . 'Controller.php') || file_exists($this->sitebasePath . '/pages/' . $seoParams[0] . '/controller.php'))) {
            $this->page = $seoParams[0];
        }
        if (isset($_REQUEST['method'])) {
            $this->method = 'action_' . $_REQUEST['method'];
        }
        if (file_exists($this->sitebasePath . '/pages/' . $this->page . '/' . $seoParams[0] . 'Controller.php') || file_exists($this->sitebasePath . '/pages/' . $this->page . '/controller.php')) {
            if ($this->page == "page") {
                if (isset($seoParams[0]) && $seoParams[0]) {
                    $sql = "select * from page where alias='" . $seoParams[0] . "' and deleted=0";
                    $row = $db->getrow($sql);
                    if ($row) {
                        $seoParams['pagedata'] = $row;
                        $this->page = "page";
                    }
                }
            } else {
                $sql = "select * from page where alias='" . $this->page . "' and deleted=0 ";
                $GLOBALS['seoParams']['pagedata'] = $db->getrow($sql);
            }
        } else {

            die("404 page not found");
        }

        require_once $vjconfig['fwbasepath'] . 'include/vjlib/libs/EntryPointController.php';

        if (file_exists($this->sitebasePath . '/bootstrap.php')) {
            require_once $this->sitebasePath . '/bootstrap.php';
            $mainController = new bootstrapController();
            $this->bootparams = $mainController->params;
        }
        global $db;

        if (file_exists($this->sitebasePath . '/' . 'pages/' . $this->page . '/' . $this->page . 'Controller.php')) {
            require_once $this->sitebasePath . '/' . 'pages/' . $this->page . '/' . $this->page . 'Controller.php';
        } else {
            require_once $this->sitebasePath . '/' . 'pages/' . $this->page . '/controller.php';
        }
        $class = $this->page . 'Controller';
        $pageController = new $class();
        $pageController->bootparams += $this->bootparams;

        if (! method_exists($pageController, $this->method)) {
            $this->method = "action_index";
        }

        if ($pageController->routes) {
            foreach ($this->routes as $key => $val) {
                if (isset($seoParams[$key])) {
                    $method = 'action_' . $val;
                    $pageController->{$method}();
                }
            }
        } else {
            end($seoParams);
            $method = prev($seoParams);
            if (method_exists($pageController, "action_" . $method)) {
                $pageController->{"action_" . $method}();
            } else {
                $pageController->{$this->method}();
            }
        }

        $this->bootparams = $pageController->bootparams;

        if ($pageController->redirectView) {
            $this->page = $pageController->redirectView['page'];
            $this->method = $pageController->redirectView['method'];
            require_once $this->sitebasePath . '/' . 'pages/' . $this->page . '/controller.php';
            $class = $this->page . 'Controller';

            $pageController = new $class();
            $pageController->bootparams = $this->bootparams;
            if (! method_exists($pageController, $this->method)) {
                $this->method = "action_index";
            }
            $pageController->{$this->method}();
            $this->bootparams = $pageController->bootparams;
        }

        if (! empty($pageController->view)) {

            require_once $vjconfig['fwbasepath'] . 'include/views/EntryPointView.php';

            $filepath = $this->sitebasePath . '/pages/' . $this->page . '/views/' . $vjconfig['sitetpl'] . '/view.' . $pageController->view . '.php';

            if (! file_exists($filepath)) {
                $filepath = $this->sitebasePath . '/pages/' . $this->page . '/views/view.' . $pageController->view . '.php';
            }
            require_once $filepath;

            $class = $this->page . 'View' . ucfirst($pageController->view);
            $view = new $class();
            $view->sitetpl = $vjconfig['sitetpl'];
            $view->bootparams = $this->bootparams;
            $view->pagetplpath = $this->sitebasePath . '/pages/' . $this->page . '/tpls/' . $vjconfig['sitetpl'] . '/';
            if (! empty($pageController->params)) {
                $view->params = $pageController->params;
            }
            $this->view = $view;

            $this->loadHeaderController();
            $this->loadFooterController();

            $this->headerparams = array_merge($this->headerparams, $view->headerparams);
            $this->footerparams = array_merge($this->footerparams, $view->footerparams);

            $this->loadHeader();
            $view->display();
            $this->loadFooter();
        }
    }

    function display()
    {}

    function loadHeaderController()
    {
        global $vjlib, $vjconfig;
        $isfile = $vjlib->loadf($this->sitebasePath . '/layout/' . $vjconfig['sitetpl'] . '/' . $vjconfig['sitetpl'] . 'HeaderController.php', false);
        if ($isfile) {
            $class = $vjconfig['sitetpl'] . 'HeaderController';
            $headerController = new $class();
            $this->headerparams += $headerController->params;
        }
    }

    function loadFooterController()
    {
        global $vjlib, $vjconfig;
        $isfile = $vjlib->loadf($this->sitebasePath . '/layout/' . $vjconfig['sitetpl'] . '/' . $vjconfig['sitetpl'] . 'FooterController.php', false);
        if ($isfile) {
            $class = $vjconfig['sitetpl'] . 'footerController';
            $footerController = new $class();
            $this->footerparams = $footerController->params;
        }
    }

    function loadHeader()
    {
        global $smarty, $vjconfig;

        $smarty->assign("bootparams", $this->bootparams);
        $smarty->assign("params", $this->view->params);
        $smarty->assign("basepath", $vjconfig['basepath']);
        $smarty->assign("baseurl", $vjconfig['baseurl']);

        $smarty->assign("headerparams", $this->headerparams);

        echo $smarty->fetch($this->sitebasePath . '/tpls/' . $vjconfig['sitetpl'] . '/header.tpl');
        echo "<script>var baseurl = '" . $vjconfig['baseurl'] . "';</script>";
        echo "<script>var fwbaseurl = '" . $vjconfig['fwbaseurl'] . "';</script>";
    }

    function loadFooter()
    {
        global $smarty, $vjconfig;
        $smarty->assign("basepath", $vjconfig['basepath']);
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $smarty->assign("params", $this->view->params);
        $smarty->assign("footerparams", $this->footerparams);
        echo $smarty->fetch($this->sitebasePath . '/tpls/' . $vjconfig['sitetpl'] . '/footer.tpl');
    }
}