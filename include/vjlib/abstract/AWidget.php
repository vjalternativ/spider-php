
<?php 
abstract class AWidget {
    
    protected $fields;
    private $widgetInstance = null;
    
    
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
    
    abstract  function processWidgetParams($params);
    
    static function processParams($widget,$params) {
        global $vjconfig;
        if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php")) {
            require_once $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
            $class = $widget.'Widget';
            $ob = new $class;
            return $ob->processWidgetParams($params);
        } else {
            die("mai yaha");
            return $params;
        }
    }
    
    
    
    
    static function loadWidget($widgetName,$params) {
        global $smarty,$vjconfig;
        $params = self::processParams($widgetName, $params);
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
    
    
}
?>