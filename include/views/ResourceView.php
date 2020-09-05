<?php

abstract class ResourceView
{


    public $params = array();
    public $listview = array();
    public $tpls = array();
    public $module = '';
    public $record = '';
    public $entity =false;
    public $data = false;
    public $tableinfo = array();
    public $tpl;
    public $isLoggedIn = false;
    public $showChatContainer = false;
    public $activeMenuId = false;
    public $activeSubmenuId = false;
    public $activeModuleId = false;
    public $isLoadHeaderFoooter =true;

    public $bootparams = array();
    public $sitetpl;
    public $pagetplpath;
    public $headerparams = array();
    public $footerparams = array();
    public $pageurlpath;
    protected $sitebasePath;


    function setLoadHeaderFooter($b=true) {
        $this->isLoadHeaderFoooter= $b;
    }

    function preDisplay() {

    }


    function afterDisplay() {
    }




    abstract function loadHeader();
    abstract function loadFooter();
    abstract function display();


    function _loadHeader() {


        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $this->sitebasePath = $vjconfig['basepath'].'resources/'.$_GET['resource'].'/';

        $smarty->assign("baseurl", $vjconfig['baseurl']);

        $smarty->assign("params", $this->params);
        $smarty->assign("headerparams", $this->headerparams);
        echo "<script>var baseurl = '" . $vjconfig['baseurl'] . "';</script>";
        echo "<script>var urlbasepath = '" . $vjconfig['urlbasepath'] . "';</script>";
        echo "<script>var fwbaseurl = '" . $vjconfig['fwbaseurl'] . "';</script>";
        echo "<script>var fwurlbasepath = '" . $vjconfig['resource_alias']['backend'] . "';</script>";
        $this->loadHeader();
        echo $smarty->fetch($this->sitebasePath . 'include/tpls/' . $vjconfig['sitetpl'] . '/header.tpl');

    }

    function _loadFooter() {
        $smarty = lib_smarty::getSmartyInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $smarty->assign("params", $this->params);
        $smarty->assign("footerparams", $this->footerparams);
        $this->loadFooter();

        echo $smarty->fetch($this->sitebasePath . 'include/tpls/' . $vjconfig['sitetpl'] . '/footer.tpl');
    }


    function show($path) {
        global $smarty;
        foreach($this->params as $key=>$val) {
            $smarty->assign($key,$val);
        }
        echo $smarty->fetch($path);
    }

    function loadTpl($tpl,$params=array()) {
        global $smarty,$vjconfig;

        $module = $this->module;

        // $smarty->assign('bootparams',$this->bootparams);
        $this->params += $params;
        $smarty->assign('params',$this->params);

        $path = $vjconfig['basepath'].'custom/modules/'.$module.'/tpls/'.$tpl;
        $content = "";
        if(file_exists($path)) {
            $content =  $smarty->fetch($path);
        }

        return $content;

    }


    function displayTpl($tpl,$params=array()) {
        global $smarty,$app_list_strings;
        $smarty->assign('bootparams',$this->bootparams);
        $this->params += $params;
        $smarty->assign('params',$this->params);
        $smarty->assign('app_list_strings',$app_list_strings);
        echo $smarty->fetch($this->pagetplpath.$tpl);
    }



    function fetch($tpl) {
        global $smarty;
        $smarty->assign('bootparams',$this->bootparams);
        $smarty->assign('params',$this->params);
        return $smarty->fetch($this->pagetplpath.$tpl);
    }

    function loadJs($filename) {
        echo '<script src="'.$this->pageurlpath."assets/js/".$filename.'"></script>';
    }

}

