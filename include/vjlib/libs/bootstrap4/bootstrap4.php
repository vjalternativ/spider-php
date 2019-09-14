<?php 

namespace SpiderPhp\Lib\Bootstrap4;

class Bootstrap4 {
    
    
    static function getCssJs($bootstrap=4.3,$jquery=3.4) {
        
        global $vjconfig;
        $link ='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/css/'.$bootstrap.'/bootstrap.min.css" />';
        $link .='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/css/util.css" />';
        $link .='<script src="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/js/jquery/'.$jquery.'/jquery.min.js"></script>';
        $link .='<script src="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/js/'.$bootstrap.'/bootstrap.min.js" ></script>';
        return $link;
               
    }
    
    
    
    static function loadWidget($widgetName = "div",$params=array()) {
        
        global $smarty,$vjconfig;
        
        $dir = __DIR__;
        $smarty->assign("params",$params);
        $html = $smarty->fetch($dir."/widgets/".$widgetName."/".$widgetName."Widget.tpl");
        if(file_exists($dir."/widgets/".$widgetName."/".$widgetName."Widget.css")) {
            $link ='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/widgets/'.$widgetName.'/'.$widgetName.'Widget.css" />';
            $html = $link.$html;   
        }
        return $html;
    }
    
}

?>