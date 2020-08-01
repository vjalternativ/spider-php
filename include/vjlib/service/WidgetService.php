<?php 
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/interface/IWidgetService.php';
require_once $vjconfig['fwbasepath'].'include/vjlib/libs/WidgetService.php';
class WidgetServiceRegistrar {
    private static $instnace = null;
    static function getInstance() {
        if(self::$instnace ==null) {
            self::$instnace = new WidgetService();
        }
        return self::getIWidgetService(self::$instnace);
   }
   private static function getIWidgetService(IWidgetService $ob) {
        return $ob;
   }
}

?>