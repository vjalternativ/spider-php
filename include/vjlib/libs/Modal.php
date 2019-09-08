<?php 
class Modal {
    public $id = "modal";
    public $formaction = false;
    public $heading = "Heading";
    public $extraheader  = false;
    public $afterheader = false;
    public $extrafooter = false;
    public $body = false;
    
    function html() {
        global $smarty;
        $smarty->assign("modal",$this);
        return $smarty->fetch("include/vjlib/libs/tpls/genericmodal.tpl");
    }
    
}
?>