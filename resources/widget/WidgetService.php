<?php

class WidgetService implements IWidgetService {




    public function getWidget($widgetType,$row=false)
    {
        $db = MysqliLib::getInstance();
        $sql = "select * from widget where deleted=0 and status='Active' and widget_type='".$widgetType."'  ";
        $rows = $db->fetchRows($sql);
        $html = '';
        foreach($rows as $row) {
            $html .= $this->getWidgetForRecord($row);
        }
        return $html;
    }

    public function getWidgetForParams($widgetType,$params) {
        $ob = $this->getWidgetObject($widgetType);
        $params = $ob->processWidgetParams( $params);
        return  $this->rendorWidget($widgetType,$params);
    }

    private function getWidgetObject($widget) {
        $vjconfig = lib_config::getInstance()->getConfig();
        $ob = false;
        if(file_exists($vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php")) {
            require_once $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/".$widget."/".$widget."Widget.php";
            $class = $widget.'Widget';
            $ob = new $class;
        } else {
            if(file_exists($vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php")) {
                require_once $vjconfig['basepath']."include/entrypoints/site/widgets/".$vjconfig['sitetpl']."/".$widget."/".$widget."Widget.php";
                $class = $widget.'Widget';
                $ob = new $class;
            }else {
                die("widget not found ".$widget);

            }
            return $ob;
        }
    }

    public function getWidgetForRecord($row,$orderByName=false) {
        $db = lib_mysqli::getInstance();
        $additionalSql= "";
        if($orderByName) {
            $additionalSql = " order by widget_attr.name ".$orderByName;
        }
        $sql = "select widget_attr.* from widget_widget_attr_1_m  inner join widget_attr  on widget_widget_attr_1_m.widget_attr_id=widget_attr.id and widget_attr.deleted=0 and widget_widget_attr_1_m.deleted=0 and widget_widget_attr_1_m.widget_id='".$row['id']."' ";
        if($additionalSql) {
            $sql .= $additionalSql;
        }
        $rows = $db->fetchRows($sql,array("id"));
        $widgetObject = $this->getWidgetObject($row['widget_type']);

        $row['config'] = json_decode($row['description'],1);

        $params =array();
        $params['config'] = $row['config'];
        $checkFirst = true;
        foreach($rows as $id => $data) {
            $params['data'][$id]["isfirst"] = false;
            if($checkFirst) {
                $params['data'][$id]["isfirst"] = true;
                $checkFirst =false;
            }
            $params['data'][$id]["name"]  = $data['name'];
            $params['data'][$id]['attrs'] = json_decode($data['description'],1);
            $params['data'][$id] = $widgetObject->processWidgetParams($params['data'][$id]);

        }

        $params['widget']  = $widgetObject->processWidgetAttrs($row);
        return $this->rendorWidget($row['widget_type'],$params);
    }
    private function getResourcesHtml() {
        $vjconfig = lib_config::getInstance()->getConfig();
        $html = "";
        $datawrapper = lib_datawrapper::getInstance();
        $widgetdatawrapper = $datawrapper->get("widget_data_wrapper");
        if($widgetdatawrapper && isset($widgetdatawrapper['resources'])) {
            foreach($widgetdatawrapper['resources'] as $path=>$resource) {
                if(isset($resource['counter']) && $resource['counter']==0)  {
                    if($resource['type']=="css") {
                        $html .='<link rel="stylesheet" href="'.$vjconfig['urlbasepath'].$path.'" />';
                    } else if($resource['type']=="js") {
                        $html .='<script src="'.$vjconfig['urlbasepath'].$path.'" ></script>';
                    }
                    unset($widgetdatawrapper['resources'][$path]);
                }
                $datawrapper->set("widget_data_wrapper", $widgetdatawrapper);
            }
        }
        return $html;
    }

    private function rendorWidget($widgetType,$params=array()) {
        $vjconfig = lib_config::getInstance()->getConfig();
        $smarty = lib_smarty::getSmartyInstance();

        $html = $this->getResourcesHtml();

        $path = 'include/entrypoints/site/widgets/'.$vjconfig['sitetpl']."/".$widgetType;
        $smarty->assign("widgetbasepath",$vjconfig['basepath'].$path);
        $smarty->assign("widgeturlbasepath",$vjconfig['urlbasepath'].$path);


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
    public function getWidgetForPage($widgetType,$orderByName=false)
    {

        $db = lib_mysqli::getInstance();
        $pageData = lib_datawrapper::getInstance()->get("pagedata");
        if($pageData) {
            $id = $pageData['id'];
            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.widget_type='".$widgetType."' and pw.page_id='".$id."' and w.status='Active' ";
            $widgets = $db->fetchRows($sql);
            $html = "";

            foreach($widgets as $widget) {
                $html .= $this->getWidgetForRecord($widget,$orderByName);
            }
            return $html;
        }

    }


}
?>