<?php

abstract class EntryPointView
{
    public $params = array();
    public $bootparams = array(); 
    public $sitetpl;
    public $pagetplpath;
    public $headerparams = array();
    public $footerparams = array();
    public $pageurlpath;
    
    function displayTpl($tpl,$params=array()) {
        global $smarty,$app_list_strings;
        $smarty->assign('bootparams',$this->bootparams);
        $this->params += $params;
        $smarty->assign('params',$this->params);
        $smarty->assign('app_list_strings',$app_list_strings);
        echo $smarty->fetch($this->pagetplpath.$tpl); 
    }
    
    abstract function display();
    
    
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

