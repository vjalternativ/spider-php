
<?php
require_once __DIR__.'/../libs/bootstrap4/IBootstrapWidgetConstant.php';

abstract class AWidget {
    
    protected $fields;
    private $widgetInstance = null;
    protected $params;
    private function getField($name,$type) {
        $fieldData = array();
        $fieldData['name'] = $name;
        $fieldData['type'] = $type;
        
        return $fieldData;
    }
    
    function registerField($name,$type) {
        $this->fields[] = $this->getField($name, $type);
    }
    
    function getFields() {
        return $this->fields;
    }
    
    static function getWidgetFields($widget){
        if(file_exists("include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php")) {
            require_once "include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
            $class = $widget.'Widget';
            $ob = new $class;
            return $ob->fields;
        } else {
            return false;
        }
    }
    
    function processWidgetParams($params) {
        return $params;
    }
    
    static function processParams($widget,$params) {
        global $vjconfig;
        
        if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php")) {
            require_once $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
            $class = $widget.'Widget';
            $ob = new $class;
            return $ob->processWidgetParams($params);
        } else {
            echo $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
            
            die("widget not found ".$widget);
            return $params;
        }
    }
    
    
    
    static function rendorWidget($widgetName,$params=array()) {
        global $vjconfig,$smarty;
        if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetName."/".$widgetName."Widget.tpl")) {
            $smarty->assign("params",$params);
            
            $html = $smarty->fetch($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetName."/".$widgetName."Widget.tpl");
            if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetName."/".$widgetName."Widget.css")) {
                $link ='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/widgets/'.$widgetName.'/'.$widgetName.'Widget.css" />';
                $html = $link.$html;
            }
            
        } else {
            die($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetName."/".$widgetName."Widget.tpl");
            
        }
        return $html;
    }
    
    
    static function loadWidget($widgetName,$params) {
        $params = self::processParams($widgetName, $params);
        return  self::rendorWidget($widgetName,$params);
    }
    
    public  function rendor($params=array()) {
        //echo get_class(self);
        $class = get_called_class();
        $widget = str_replace("Widget", "", $class);
       return $this->rendorWidget($widget,$this->params);
    
    }
    
    
}
?>