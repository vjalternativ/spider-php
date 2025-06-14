<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'resources/widget/IWidgetService.php';
require_once $vjconfig['fwbasepath'] . 'resources/widget/WidgetService.php';
require_once $vjconfig['fwbasepath'] . 'resources/widget/AWidget.php';
require_once $vjconfig['fwbasepath'] . 'resources/widget/WidgetResourceController.php';

class WidgetService implements IWidgetService
{

    private static $instance = null;

    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new WidgetService();
        }
        return self::asIWidgetService(self::$instance);
    }

    private static function asIWidgetService(IWidgetService $ob)
    {
        return $ob;
    }

    public function getWidget($widgetType, $row = false)
    {
        $db = lib_database::getInstance();
        $sql = "select * from widget where deleted=0 and status='Active' and widget_type='" . $widgetType . "'  ";
        $rows = $db->fetchRows($sql);
        $html = '';
        foreach ($rows as $row) {
            $html .= $this->getWidgetForRecord($row);
        }
        return $html;
    }

    public function getWidgetForParams($widgetType, $params)
    {
        $ob = $this->getWidgetObject($widgetType);

        if ($ob) {

            $params = $ob->processWidgetParams($params);

            return $this->rendorWidget($ob, $params);
        } else {
            echo $widgetType . " not found <br />";
        }
    }

    private function _geWidgetObject(WidgetResourceController $ob)
    {
        return $ob;
    }

    private function getWidgetObjectClass($widget)
    {
        $baseClass = $widget . 'WidgetController';

        return lib_util::loadAvailableFile($baseClass, "widget/modules/" . $widget);
    }

    private function getWidgetObject($widget)
    {
        $class = $this->getWidgetObjectClass($widget);

        if ($class) {
            $ob = new $class();
            return $this->_geWidgetObject($ob);
        }
        return false;
    }

    public function getWidgetForRecord($row, $orderByName = false)
    {
        $db = lib_database::getInstance();
        $additionalSql = "";
        if ($orderByName) {
            $additionalSql = " order by widget_attr.name " . $orderByName;
        }
        $sql = "select widget_attr.* from widget_widget_attr_1_m  inner join widget_attr  on widget_widget_attr_1_m.widget_attr_id=widget_attr.id and widget_attr.deleted=0 and widget_widget_attr_1_m.deleted=0 and widget_widget_attr_1_m.widget_id='" . $row['id'] . "' ";
        if ($additionalSql) {
            $sql .= $additionalSql;
        }
        $rows = $db->fetchRows($sql, array(
            "id"
        ));
        $widgetObject = $this->getWidgetObject($row['widget_type']);

        $row['config'] = json_decode($row['description'], 1);

        $params = array();
        $params['config'] = $row['config'];
        $checkFirst = true;
        foreach ($rows as $id => $data) {
            $params['data'][$id]["isfirst"] = false;
            if ($checkFirst) {
                $params['data'][$id]["isfirst"] = true;
                $checkFirst = false;
            }
            $params['data'][$id]["name"] = $data['name'];
            $params['data'][$id]['attrs'] = json_decode($data['description'], 1);
            $params['data'][$id] = $widgetObject->processWidgetParams($params['data'][$id]);
        }
        $params['widget'] = $widgetObject->processWidgetAttrs($row);
        return $this->rendorWidget($widgetObject, $params);
    }

    private function getResourcesHtml()
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $html = "";
        $datawrapper = lib_datawrapper::getInstance();
        $widgetdatawrapper = $datawrapper->get("widget_data_wrapper");
        if ($widgetdatawrapper && isset($widgetdatawrapper['resources'])) {
            foreach ($widgetdatawrapper['resources'] as $path => $resource) {
                if (isset($resource['counter']) && $resource['counter'] == 0) {
                    if ($resource['type'] == "css") {
                        $html .= '<link rel="stylesheet" href="' . $vjconfig['urlbasepath'] . $path . '" />';
                    } else if ($resource['type'] == "js") {
                        $version = $resource['version'];
                        $html .= '<script src="' . $vjconfig['urlbasepath'] . $path . '?v=' . $version . '" ></script>';
                    }
                    unset($widgetdatawrapper['resources'][$path]);
                }
                $datawrapper->set("widget_data_wrapper", $widgetdatawrapper);
            }
        }
        return $html;
    }

    private function rendorWidget(WidgetResourceController $ob, $params = array())
    {
        $html = $this->getResourcesHtml();

        $html .= $ob->rendorTpl($ob->getModule() . 'Widget.tpl', $params, false, $ob->getModule());

        return $html;
    }

    private function _getWidgetForSql($sql, $orderByName = false)
    {
        $db = lib_database::getInstance();
        $widgets = $db->fetchRows($sql);
        $html = "";
        foreach ($widgets as $widget) {
            $html .= $this->getWidgetForRecord($widget, $orderByName);
        }
        return $html;
    }

    private function _getWidgetForPageAtPosition($widgetType, $pos = false, $orderByName = false)
    {
        $pageData = lib_datawrapper::getInstance()->get("pagedata");
        if ($pageData) {
            $id = $pageData['id'];
            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.widget_type='" . $widgetType . "' and pw.page_id='" . $id . "' and w.status='Active' ";
            if ($pos) {
                $sql .= " AND w.position='" . $pos . "' ";
            }
            return $this->_getWidgetForSql($sql, $orderByName);
        }
    }

    public function getWidgetForPage($widgetType, $orderByName = false)
    {
        return $this->_getWidgetForPageAtPosition($widgetType, false, $orderByName);
    }

    public function getWidgetFileds($widgetType)
    {
        $widget = $this->getWidgetObject($widgetType);
        if ($widget) {
            return $widget->getFields();
        }
        return false;
    }

    public function getWidgetAtPosition($pos, $orderByName = false)
    {
        $sql = "select w.* from widget w WHERE w.deleted=0 and  w.position='" . $pos . "' ";
        return $this->_getWidgetForSql($sql, $orderByName);
    }

    public function getWidgetConfigFields($widgetType)
    {
        $widget = $this->getWidgetObject($widgetType);
        if ($widget) {
            return $widget->getConfigFields();
        }
        return false;
    }

    public function getWidgetForAlias($alias, $orderByName = false)
    {
        $sql = "select * from widget where alias='" . $alias . "' and status='Active' and deleted=0 ";
        $row = lib_database::getInstance()->getrow($sql);
        if ($row) {
            return $this->getWidgetForRecord($row);
        }

        return false;
    }
}
?>