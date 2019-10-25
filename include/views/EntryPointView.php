<?php

abstract class EntryPointView
{
    public $params = array();
    public $bootparams = array(); 
    public $sitetpl;
    public $pagetplpath;
    function displayTpl($tpl,$params=array()) {
        global $smarty;
        $smarty->assign('bootparams',$this->bootparams);
        $this->params += $params;
        $smarty->assign('params',$this->params);       
        echo $smarty->fetch($this->pagetplpath.$tpl); 
    }
    
    abstract function display();
    
    
    function fetch($tpl) {
        global $smarty;
        
        return $smarty->fetch($this->pagetplpath.$tpl);
    }

}

