<?php 

class Widget implements IWidget {
    
    public function getWidget($widgetType)
    {
        $db = MysqliLib::getInstance();
        $sql = "select * from widget where deleted=0 and status='Active' and widget_type='".$widgetType."'  ";
        $rows = $db->fetchRows($sql);
        $html = '';
        foreach($rows as $row) {
            $html .= $this->loadWidgetByData($row);
        }
        return $html;
    }
    
    public function getWidgetByParams($widgetType,$params) {
        $params = $this->processParams($widgetType, $params);
        return  $this->rendorWidget($widgetType,$params);
    }

    private function rendorWidget($widgetType,$params=array()) {
        global $vjconfig,$smarty;
        
        $path = 'include/entrypoints/site/widgets/'.$vjconfig['sitetpl']."/".$widgetType;
        $smarty->assign("widgetbasepath",$vjconfig['basepath'].$path);
        $smarty->assign("widgeturlbasepath",$vjconfig['urlbasepath'].$path);
        $html = "";
        $datawrapper = DataWrapper::getInstance();
        $widgetdatawrapper = $datawrapper->get($widgetType);
        
        if($widgetdatawrapper && isset($widgetdatawrapper['resources'])) {
            foreach($widgetdatawrapper['resources'] as $relativefilepath=>$resource) {
                if(isset($resource['counter']) && $resource['counter']==0)  {
                    $path = 'include/entrypoints/site/widgets/'.$vjconfig['sitetpl']."/".$widgetType."/assets/".$resource['type']."/".$relativefilepath;
                    if($resource['type']=="css") {
                        $html .='<link rel="stylesheet" href="'.$vjconfig['urlbasepath'].$path.'" />';
                    } else if($resource['type']=="js") {
                        $html .='<script src="'.$vjconfig['urlbasepath'].$path.'" ></script>';
                    }
                }
            }
        }
        
        
        
        
        
        if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetType."/".$widgetType."Widget.tpl")) {
            $smarty->assign("params",$params);
            
            $html .= $smarty->fetch($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetType."/".$widgetType."Widget.tpl");
            if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetType."/".$widgetType."Widget.css")) {
                $link ='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/widgets/'.$widgetType.'/'.$widgetType.'Widget.css" />';
                $html = $link.$html;
            }
            
        } else {
            if(file_exists($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widgetType."/".$widgetType."Widget.tpl")) {
                $smarty->assign("params",$params);
                $html .= $smarty->fetch($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widgetType."/".$widgetType."Widget.tpl");
            } else {
                die($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widgetType."/".$widgetType."Widget.tpl not f" );
            }
        }
        return $html;
    }
    
    private function processParams($widget,$params) {
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
    
    private function loadWidgetByData($row,$additionalSql=false) {
        
        global $db;
        $sql = "select widget_attr.* from widget_widget_attr_1_m  inner join widget_attr  on widget_widget_attr_1_m.widget_attr_id=widget_attr.id and widget_attr.deleted=0 and widget_widget_attr_1_m.deleted=0 and widget_widget_attr_1_m.widget_id='".$row['id']."' ";
        if($additionalSql) {
            $sql .= $additionalSql;
        }
        $rows = $db->fetchRows($sql,array("id"));
        
        $params = $row;
        
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
        $params = $this->processAttrs($row, $params);
        return $this->getWidgetByParams($row['widget_type'],$params);
    }
    
    
    private function processAttrs($widgetData,$params) {
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

    
}
?>