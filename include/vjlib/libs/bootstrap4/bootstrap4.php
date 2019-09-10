<?php 

namespace SpiderPhp\Lib\Bootstrap4;

class Bootstrap4 {
    
    function loadWidget($widgetName = "div",$params=array()) {
        
        global $smarty;
        
        $dir = __DIR__;
        $smarty->assign("params",$params);
        $html = $smarty->fetch($dir."/widgets/".$widgetName."/".$widgetName."Widget.tpl");
        
    }
    
}

?>