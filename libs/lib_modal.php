<?php
namespace spider\libs;
class lib_modal {
    public $id = "modal";
    public $formaction = false;
    public $heading = "Heading";
    public $extraheader  = false;
    public $afterheader = false;
    public $extrafooter = false;
    public $body = false;

    function html() {
        $vjconfig = lib_config::getInstance()->getConfig();
        $smarty = lib_smarty::getSmartyInstance();
        $smarty->assign("modal",$this);
        return $smarty->fetch($vjconfig['fwbasepath']."include/vjlib/libs/tpls/genericmodal.tpl");
    }

}
?>