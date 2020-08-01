<?php 
class ModalUtil {
  static function getModal($id,$title,$bgclass,$body,$footer=false,$footercontent=false ,$display=false){
        $enquiryModalParams = array();
        $enquiryModalParams['id'] = $id;
        $enquiryModalParams['title'] = $title;
        $enquiryModalParams['headerbgclass'] = $bgclass;
        $enquiryModalParams['body'] = $body;
        $enquiryModalParams['display'] = $display;
        if($footer) {
            $enquiryModalParams['footer'] = $footer;
            $enquiryModalParams['footerbutton'] = $footercontent;
        }
        $widgetService = WidgetServiceRegistrar::getWidgetServiceInstance();
        return   $widgetService->getWidget("bs3modal", $enquiryModalParams);
    }
}
?>