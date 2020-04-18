
<?php
require_once __DIR__.'/../libs/bootstrap4/IBootstrapWidgetConstant.php';

abstract class AWidget {
    
    protected $fields;
    protected $configFields;
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
        
        global $vjconfig;
        $file = "include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
        
        $isFound = false;
        if(file_exists($file)) {
            $isFound = true;
        } else {
            $file = $vjconfig['basepath'].'include/entrypoints/site/widgets/'.$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php";
            if(file_exists($file)) {
                $isFound = true;
            }
        }
        
        if($isFound) {
            require_once $file;
            
            
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
            if(file_exists($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php")) {
                require_once $vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php";
                $class = $widget.'Widget';
                $ob = new $class;
                return $ob->processWidgetParams($params);
            }else {
                echo $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
                die("widget not found ".$widget);
                
            }
            return $params;
        }
    }
    
    function processWidgetAttrs($params) {
        return $params;
    }
    
    static function processAttrs($widgetData,$params) {
        global $vjconfig;
        $widget = $widgetData['widget_type'];
        $params['widget'] = $widgetData;
        if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php")) {
            require_once $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
            $class = $widget.'Widget';
            $ob = new $class;
            return $ob->processWidgetAttrs($params);
        } else {
            if(file_exists($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php")) {
                require_once $vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php";
                $class = $widget.'Widget';
                $ob = new $class;
                return $ob->processWidgetAttrs($params);
            }else {
                echo $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
                die("widget not found ".$widget);
                
            }
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
            if(file_exists($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widgetName."/".$widgetName."Widget.tpl")) {
                $smarty->assign("params",$params);
                $html = $smarty->fetch($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widgetName."/".$widgetName."Widget.tpl");
            } else {
                die($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetName."/".$widgetName."Widget.tpl not f" );
            }
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
    
    static function loadWidgetAtPositionByPage($pos) {
        global $seoParams,$db;
        
        
        $pageData = $seoParams['pagedata'];
        if($pageData) {
            $id = $pageData['id'];
            
            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.position='".$pos."' and pw.page_id='".$id."' and w.status='Active' ";
            $widgets = $db->fetchRows($sql);
            $html = "";
            foreach($widgets as $widget) {
                $html .= self::rendorForPage($widget);
            }
            return $html;
        }
    }
    
    static function loadWidgetByPage($widget) {
        global $seoParams,$db;
        
        
        $pageData = $seoParams['pagedata'];
        if($pageData) {
            $id = $pageData['id'];
            
            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.widget_type='".$widget."' and pw.page_id='".$id."' and w.status='Active' ";
            $widgets = $db->fetchRows($sql);
            $html = "";
            foreach($widgets as $widget) {
                $html .= self::rendorForPage($widget);
            }
            return $html;
        }
    }
    
    static function loadWidgetAtPosition($pos) {
        
        global $db;
        $sql = "select * from widget where deleted=0 and status='Active' and position = '".$pos."' ";
        $rows = $db->fetchRows($sql);
        $html = '';
        foreach($rows as $row) {
            $html .= self::rendorForPage($row);
        }
        return $html;
        
    }
    
    
    private static function rendorForPage($row) {
        global $db;
        $sql = "select wa.* from widget_widget_attr_1_m wwa inner join widget_attr wa on wwa.widget_attr_id=wa.id and wa.deleted=0 and wwa.deleted=0 and wwa.widget_id='".$row['id']."' ";
        $rows = $db->fetchRows($sql,array("id"));
        
        $params = array();
        
        $checkFirst = true;
        foreach($rows as $id => $data) {
            
            $params['data'][$id]["isfirst"] = false;
            
            if($checkFirst) {
                $params['data'][$id]["isfirst"] = true;
                $checkFirst =false;
            }
            $params['data'][$id]["name"]  = $data['name'];
            $params['data'][$id]['attrs'] = json_decode($data['description'],1);
            $params['data'][$id] = self::processParams($row['widget_type'],$params['data'][$id]);
            
        }
        $params = self::processAttrs($row, $params);
        //review karna hai
        return self::loadWidget($row['widget_type'],$params);
        
        
    }
    
    function registerConfigField($name,$type) {
            $this->configFields[] = $this->getField($name, $type);
    }
    
    function getConfigFields() {
        return $this->configFields;
    }
    
    static function getWidgetConfigFields($widget){
        
        global $vjconfig;
        $file = "include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
        
        $isFound = false;
        if(file_exists($file)) {
            $isFound = true;
        } else {
            $file = $vjconfig['basepath'].'include/entrypoints/site/widgets/'.$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php";
            if(file_exists($file)) {
                $isFound = true;
            }
        }
        
        if($isFound) {
            require_once $file;
            
            
            $class = $widget.'Widget';
            $ob = new $class;
            return $ob->configFields;
        } else {
            return false;
        }
    }
}
?>