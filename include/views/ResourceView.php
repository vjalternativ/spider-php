<?php

abstract class ResourceView
{

    public $params = array();

    public $listview = array();

    public $tpls = array();

    public $module = '';

    public $record = '';

    public $entity = false;

    public $data = false;

    public $tableinfo = array();

    public $tpl;

    public $isLoggedIn = false;

    public $showChatContainer = false;

    public $activeMenuId = false;

    public $activeSubmenuId = false;

    public $activeModuleId = false;

    public $isLoadHeaderFoooter = true;

    public $bootparams = array();

    public $sitetpl;

    public $pagetplpath;

    protected $defaultTplPath;

    public $headerparams = array();

    public $footerparams = array();

    public $moduleUrlPath;

    public $moduleBasePath;

    protected $sitebasePath;

    protected $tplPath;

    function __construct()
    {}

    function setLoadHeaderFooter($b = true)
    {
        $this->isLoadHeaderFoooter = $b;
    }

    function preDisplay()
    {}

    function afterDisplay()
    {}

    abstract function loadHeader();

    abstract function loadFooter();

    abstract function display();

    function _loadHeader()
    {
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $this->sitebasePath = 'resources/' . $_GET['resource'] . '/';

        $pagedata = lib_datawrapper::getInstance()->get("pagedata");
        if ($pagedata) {
            $pagedata['template'] = isset($pagedata['template']) ? trim($pagedata['template']) : '';
        }
        $this->sitetpl = $pagedata ? (isset($pagedata["template"]) ? (! empty($pagedata['template']) ? $pagedata['template'] : $vjconfig['sitetpl']) : $vjconfig['sitetpl']) : $vjconfig['sitetpl'];
        $this->moduleBasePath = $vjconfig['basepath'] . $this->sitebasePath . 'modules/' . $_GET['module'] . '/';
        $this->moduleUrlPath = $vjconfig['baseurl'] . $this->sitebasePath . 'modules/' . $_GET['module'] . '/';
        $this->pagetplpath = $this->moduleBasePath . 'tpls/' . $this->sitetpl . '/';
        $this->defaultTplPath = $this->sitebasePath . 'modules/' . $_GET['module'] . '/tpls/default/';
        $this->tplPath = $this->sitebasePath . 'modules/' . $_GET['module'] . '/tpls/';
        $smarty->assign("baseurl", $vjconfig['baseurl']);
        $smarty->assign("params", $this->params);
        $smarty->assign("headerparams", $this->headerparams);
        echo "<script>var baseurl = '" . $vjconfig['baseurl'] . "';</script>";
        echo "<script>var urlbasepath = '" . $vjconfig['urlbasepath'] . "';</script>";
        echo "<script>var fwbaseurl = '" . $vjconfig['fwbaseurl'] . "';</script>";
        echo "<script>var fwurlbasepath = '" . $vjconfig['resource_alias']['backend'] . "';</script>";

        $this->loadHeader();
        $this->displayHeader();
    }

    private function displayTemplate($file)
    {
        $vjconfig = lib_config::getInstance()->getConfig();

        $dir = $vjconfig['basepath'] . $this->sitebasePath . 'include/tpls/';
        $smarty = lib_smarty::getSmartyInstance();
        $smarty->assign("params", $this->params);
        if (file_exists($dir . $this->sitetpl . '/' . $file)) {
            echo $smarty->fetch($dir . $this->sitetpl . '/' . $file);
        } else if (file_exists($dir . $file)) {
            echo $smarty->fetch($dir . $file);
        } else {
            $dir = $vjconfig['fwbasepath'] . $this->sitebasePath . 'include/tpls/';
            if (file_exists($dir . $this->sitetpl . '/' . $file)) {
                echo $smarty->fetch($dir . $this->sitetpl . '/' . $file);
            } else if (file_exists($dir . $file)) {
                echo $smarty->fetch($dir . $file);
            } else {
                die("file not found " . $dir . $this->sitetpl . '/' . $file);
            }
        }
    }

    function displayHeader()
    {
        $this->displayTemplate("header.tpl");
    }

    function _loadFooter()
    {
        $smarty = lib_smarty::getSmartyInstance();
        $smarty->assign("params", $this->params);
        $smarty->assign("footerparams", $this->footerparams);
        $this->loadFooter();
        $this->displayFooter();
    }

    function displayFooter()
    {
        $this->displayTemplate("footer.tpl");
    }

    function show($path)
    {
        $smarty = lib_smarty::getSmartyInstance();
        foreach ($this->params as $key => $val) {
            $smarty->assign($key, $val);
        }
        echo $smarty->fetch($path);
    }

    function loadTpl($tpl, $params = array())
    {
        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");
        $smarty = lib_smarty::getSmartyInstance();

        $smarty->assign('bootparams', $this->bootparams);
        $this->params += $params;
        $smarty->assign('params', $this->params);
        $smarty->assign('app_list_strings', $app_list_strings);
        if (file_exists($this->pagetplpath . $tpl)) {
            return $smarty->fetch($this->pagetplpath . $tpl);
        } else if (file_exists($this->defaultTplPath . $tpl)) {
            return $smarty->fetch($this->defaultTplPath . $tpl);
        } else if (file_exists($this->tplPath . $tpl)) {
            return $smarty->fetch($this->tplPath . $tpl);
        } else if (file_exists('spider-php/' . $this->defaultTplPath . $tpl)) {
            return $smarty->fetch('spider-php/' . $this->defaultTplPath . $tpl);
        } else if (file_exists('spider-php/' . $this->tplPath . $tpl)) {
            return $smarty->fetch('spider-php/' . $this->tplPath . $tpl);
        } else {
            echo $this->pagetplpath . $tpl . ' not exist <br />';
            echo $this->defaultTplPath . $tpl . ' not exist <br />';
            echo $this->tplPath . $tpl . ' not exist <br />';
            echo 'spider-php/' . $this->defaultTplPath . $tpl . ' not exist <br />';
            echo 'spider-php/' . $this->tplPath . $tpl . ' not exist <br />';

            die();
        }
    }

    function displayTpl($tpl, $params = array())
    {
        echo $this->loadTpl($tpl, $params);
    }

    function fetch($tpl)
    {
        $smarty = lib_smarty::getSmartyInstance();
        $smarty->assign('bootparams', $this->bootparams);
        $smarty->assign('params', $this->params);
        return $smarty->fetch($this->pagetplpath . $tpl);
    }

    function loadJs($filename, $insideModule = true, $insideProject = true)
    {
        if ($insideModule) {
            echo '<script src="' . $this->moduleUrlPath . "assets/js/" . $filename . '"></script>';
        } else {
            if ($insideProject) {
                echo '<script src="' . lib_config::getInstance()->get("baseurl") . $filename . '"></script>';
            }
        }
    }

    function mergeParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }

    function rendorSiteTpl($tpl, $params = array(), $sitetpl = false)
    {
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $this->params += $params;
        $siteTplPath = $sitetpl ? $this->sitebasePath . 'include/tpls/' . $sitetpl . '/' : $this->sitebasePath . 'include/tpls/' . $vjconfig['sitetpl'] . '/';
        $smarty->assign("params", $this->params);
        return $smarty->fetch($siteTplPath . $tpl);
    }

    function loadCss($filename, $insideModule = true, $insideProject = true)
    {
        if ($insideModule) {
            echo '<link rel="stylesheet" href="' . $this->moduleUrlPath . "assets/css/" . $filename . '" />';
        } else {
            if ($insideProject) {
                echo '<link rel="stylesheet" href="' . lib_config::getInstance()->get("baseurl") . $filename . '" />';
            }
        }
    }
}
