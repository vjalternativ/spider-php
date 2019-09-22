<?php 
require_once 'include/vjlib/abstract/APosition.php';
class widgetController extends VJController {
    
    function action_ajaxGetPositions() {
        
        
        global $vjconfig;
        $page = $_GET['page'];
        if(file_exists($vjconfig['basepath']."include/entrypoints/site/layout/".$vjconfig['sitetpl']."/".$vjconfig['sitetpl']."Positions.php")) {
            require_once $vjconfig['basepath']."include/entrypoints/site/layout/".$vjconfig['sitetpl']."/".$vjconfig['sitetpl']."Positions.php";
        }
        if(file_exists($vjconfig['basepath']."include/entrypoints/site/pages/".$page."/layout/".$vjconfig['sitetpl']."/".$page."Positions.php")) {
            require_once $vjconfig['basepath']."include/entrypoints/site/pages/".$page."/layout/".$vjconfig['sitetpl']."/".$page."Positions.php";
        }
        $posList = APosition::getPositions();
        $html = '<option value="">Select</option>';
        foreach($posList as $pos) {
            $html .= '<option value="'.$pos.'">'.$pos.'</option>';
        }
        echo $html;
        
        
        
        
        
    }
}
?>