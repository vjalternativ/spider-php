<?php
$vjconfig = lib_config::getInstance()->getConfig();
class widgetBackendController extends BackendResourceController {

    function action_ajaxGetPositions() {


        $vjconfig = lib_config::getInstance()->getConfig();
        $page = $_GET['page'];
        if(file_exists($vjconfig['basepath']."include/entrypoints/site/layout/".$vjconfig['sitetpl']."/".$vjconfig['sitetpl']."Positions.php")) {
            require_once $vjconfig['basepath']."include/entrypoints/site/layout/".$vjconfig['sitetpl']."/".$vjconfig['sitetpl']."Positions.php";
        }
        if(file_exists($vjconfig['basepath']."include/entrypoints/site/pages/".$page."/layout/".$vjconfig['sitetpl']."/".$page."Positions.php")) {
            require_once $vjconfig['basepath']."include/entrypoints/site/pages/".$page."/layout/".$vjconfig['sitetpl']."/".$page."Positions.php";
        }
        $posList = array(); //todo pos list support
        $html = '<option value="">Select</option>';
        foreach($posList as $pos) {
            $html .= '<option value="'.$pos.'">'.$pos.'</option>';
        }
        echo $html;





    }
}
?>