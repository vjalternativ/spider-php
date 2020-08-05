<?php 
class ModalUtil {
    static function getModal($id,$showheader,$title,$header,$bgclass,$body,$showfooter=false,$footercontent=false ,$display=false,$isFullScreen=false){
        $params = array();
        $params['id'] = $id;
        $params['showheader'] = $showheader;
        $params['header'] = $header;
        $params['title'] = $title;
        $params['headerbgclass'] = $bgclass;
        $params['body'] = $body;
        $params['display'] = $display;
        $params['isfullscreen'] = $isFullScreen;
        
        if($showfooter) {
            $params['showfooter'] = $showfooter;
            $params['footerbutton'] = $footercontent;
        }
        $widgetService = WidgetServiceRegistrar::getWidgetServiceInstance();
        return $widgetService->getWidgetForParams("bs3modal", $params);
    }
    
    
    static function getBlockModalWithoutHeaderAndFooter($id,$body) {
       return self::getModal($id,false,false,false,false,$body,false,false ,true);
    }
    
    static function getBlockModalWithoutFooter($id,$title,$body,$isFullScreen=false) {
        return self::getModal($id,true,$title,false,"primary",$body,false,false ,true,$isFullScreen);
    }
}
?>