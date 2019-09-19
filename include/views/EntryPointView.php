<?php

abstract class EntryPointView
{
    public $params = array();
    public $bootparams = array(); 
    public $sitetpl;
    public $pagetplpath;
    function displayTpl($tpl,$params) {
        global $smarty;
        $smarty->assign('bootparams',$this->bootparams);
        $smarty->assign('params',$this->params);       
        $smarty->assign("viewparams",$params);
        echo $smarty->fetch($this->pagetplpath.$tpl); 
    }
    
    abstract function display();
    
    
    function fetch($tpl) {
        global $smarty;
        
        return $smarty->fetch($this->pagetplpath.$tpl);
    }

}

