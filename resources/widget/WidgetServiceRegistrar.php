<?php
 $vjconfig= lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'].'resources/widget/IWidgetService.php';
require_once $vjconfig['fwbasepath'].'resources/widget/WidgetService.php';
require_once $vjconfig['fwbasepath'].'resources/widget/AWidget.php';
require_once $vjconfig['fwbasepath'].'resources/widget/WidgetResourceController.php';

class WidgetServiceRegistrar {
    private static $instnace = null;
    static function getWidgetServiceInstance() {
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