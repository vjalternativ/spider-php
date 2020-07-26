<?php 
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/interface/IWidget.php';
require_once $vjconfig['fwbasepath'].'include/vjlib/libs/Widget.php';
class WidgetService {
    private static $instnace = null;
    static function getInstance() {
        if(self::$instnace ==null) {
            self::$instnace = new Widget();
        }
        return self::getIWidget(self::$instnace);
   }
   private static function getIWidget(IWidget $ob) {
        return $ob;
   }
}

?>