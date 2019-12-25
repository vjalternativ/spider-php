<?php 
require_once 'controlarea/include/vjlib/abstract/APosition.php';
require_once 'include/entrypoints/site/layout/enr/enrPositions.php';
require_once 'controlarea/include/vjlib/libs/bootstrap4/bootstrap4.php';
require_once 'controlarea/include/vjlib/libs/bootstrap4/IBootstrapWidgetConstant.php';


class enrFooterController extends EntryPointController {
        
    function loadFooter() {
        global $smarty;
        $footer = Bootstrap4::loadWidgetAtPositionByPage(enrPositions::$CONTENT_BOTTOM) ;   
        
        $footer .= AWidget::rendorWidget(IBootstrapWidgetConstant::$MODAL,array("id"=>"primary_modal","title"=>"","body"=>""));   
        $smarty->assign("footer",$footer);
    }
}