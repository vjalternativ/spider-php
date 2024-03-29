<?php

class WidgetResourceController extends ResourceController
{

    protected $fields = array();

    protected $configFields = array();

    private $widgetInstance = null;

    private function getField($name, $type, $col = 6)
    {
        $fieldData = array();
        $fieldData['name'] = $name;
        $fieldData['type'] = $type;
        $fieldData['gridsize'] = $col;

        return $fieldData;
    }

    function registerField($name, $type)
    {
        $this->fields[] = $this->getField($name, $type);
    }

    function getFields()
    {
        return $this->fields;
    }

    static function getWidgetFields($widget)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $file = "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php";

        $isFound = false;
        if (file_exists($file)) {
            $isFound = true;
        } else {
            $file = $vjconfig['basepath'] . 'include/entrypoints/site/widgets/' . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php";
            if (file_exists($file)) {
                $isFound = true;
            }
        }

        if ($isFound) {
            require_once $file;

            $class = $widget . 'Widget';
            $ob = new $class();
            return $ob->fields;
        } else {
            return false;
        }
    }

    function processWidgetParams($params)
    {
        return $params;
    }

    static function processParams($widget, $params)
    {
        $vjconfig = lib_config::getInstance()->getConfig();

        if (file_exists($vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php")) {
            require_once $vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php";
            $class = $widget . 'Widget';
            $ob = new $class();
            return $ob->processWidgetParams($params);
        } else {
            if (file_exists($vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php")) {
                require_once $vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php";
                $class = $widget . 'Widget';
                $ob = new $class();
                return $ob->processWidgetParams($params);
            } else {
                echo $vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php";
                die(" widget not found " . $widget);
            }
            return $params;
        }
    }

    function processWidgetAttrs($params)
    {
        return $params;
    }

    static function processAttrs($widgetData, $params)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $widget = $widgetData['widget_type'];
        $params['widget'] = $widgetData;
        if (file_exists($vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php")) {
            require_once $vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php";
            $class = $widget . 'Widget';
            $ob = new $class();
            return $ob->processWidgetAttrs($params);
        } else {
            if (file_exists($vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php")) {
                require_once $vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php";
                $class = $widget . 'Widget';
                $ob = new $class();
                return $ob->processWidgetAttrs($params);
            } else {
                echo $vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php";
                die("widget not found " . $widget);
            }
            return $params;
        }
    }

    static function rendorWidget($widgetName, $params = array())
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $smarty = lib_smarty::getSmartyInstance();

        $path = 'include/entrypoints/site/widgets/' . $vjconfig['sitetpl'] . "/" . $widgetName;
        $smarty->assign("widgetbasepath", $vjconfig['basepath'] . $path);
        $smarty->assign("widgeturlbasepath", $vjconfig['urlbasepath'] . $path);

        $html = "";
        $datawrapper = lib_datawrapper::getInstance();
        $widgetdatawrapper = $datawrapper->get("widget_data_wrapper");

        if ($widgetdatawrapper && isset($widgetdatawrapper['resources'])) {
            foreach ($widgetdatawrapper['resources'] as $path => $resource) {
                if (isset($resource['counter']) && $resource['counter'] == 0) {
                    if ($resource['type'] == "css") {

                        $html .= '<link rel="stylesheet" href="' . $vjconfig['urlbasepath'] . $path . '" />';
                    } else if ($resource['type'] == "js") {
                        $html .= '<script src="' . $vjconfig['urlbasepath'] . $path . '" ></script>';
                    }
                }
            }
        }

        if (file_exists($vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widgetName . "/" . $widgetName . "Widget.tpl")) {
            $smarty->assign("params", $params);

            $html .= $smarty->fetch($vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widgetName . "/" . $widgetName . "Widget.tpl");
            if (file_exists($vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widgetName . "/" . $widgetName . "Widget.css")) {
                $link = '<link rel="stylesheet" href="' . $vjconfig['fwbaseurl'] . 'include/vjlib/libs/bootstrap4/widgets/' . $widgetName . '/' . $widgetName . 'Widget.css" />';
                $html = $link . $html;
            }
        } else {
            if (file_exists($vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widgetName . "/" . $widgetName . "Widget.tpl")) {
                $smarty->assign("params", $params);
                $html .= $smarty->fetch($vjconfig['basepath'] . "include/entrypoints/site/widgets/" . $vjconfig['sitetpl'] . "/" . $widgetName . "/" . $widgetName . "Widget.tpl");
            } else {
                die($vjconfig['fwbasepath'] . "include/vjlib/libs/bootstrap4/widgets/" . $widgetName . "/" . $widgetName . "Widget.tpl not f");
            }
        }
        return $html;
    }

    static function loadWidget($widgetName, $params)
    {
        $params = self::processParams($widgetName, $params);
        return self::rendorWidget($widgetName, $params);
    }

    public function rendor($params = array())
    {
        return $this->rendorTpl($this->module . 'Widget.tpl', $params);
    }

    static function loadWidgetAtPositionByPage($pos)
    {
        $seoParams = lib_seo::getInstance()->getParams();
        $db = lib_database::getInstance();

        $pageData = $seoParams['pagedata'];
        if ($pageData) {
            $id = $pageData['id'];

            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.position='" . $pos . "' and pw.page_id='" . $id . "' and w.status='Active' ";
            $widgets = $db->fetchRows($sql);
            $html = "";
            foreach ($widgets as $widget) {
                $html .= self::rendorForPage($widget);
            }
            return $html;
        }
    }

    static function loadWidgetByPage($widget, $addtionalSqlForAttr = false, $additionalSqlForWidget = false)
    {
        $db = lib_database::getInstance();
        $pageData = lib_datawrapper::getInstance()->get("pagedata");
        if ($pageData) {
            $id = $pageData['id'];
            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.widget_type='" . $widget . "' and pw.page_id='" . $id . "' and w.status='Active' ";
            $widgets = $db->fetchRows($sql);
            $html = "";
            foreach ($widgets as $widget) {
                if (isset($widget['description'])) {
                    if ($widget['description']) {
                        $widget['config'] = json_decode($widget['description'], 1);
                    }
                }
                $html .= self::rendorForPage($widget, $addtionalSqlForAttr);
            }
            return $html;
        }
    }

    static function loadWidgetAtPosition($pos)
    {
        $db = lib_database::getInstance();
        $sql = "select * from widget where deleted=0 and status='Active' and position = '" . $pos . "' ";
        $rows = $db->fetchRows($sql);
        $html = '';
        foreach ($rows as $row) {
            $html .= self::rendorForPage($row);
        }
        return $html;
    }

    private static function rendorForPage($row, $additionalSql)
    {
        $db = lib_database::getInstance();
        $sql = "select widget_attr.* from widget_widget_attr_1_m  inner join widget_attr  on widget_widget_attr_1_m.widget_attr_id=widget_attr.id and widget_attr.deleted=0 and widget_widget_attr_1_m.deleted=0 and widget_widget_attr_1_m.widget_id='" . $row['id'] . "' ";
        if ($additionalSql) {
            $sql .= $additionalSql;
        }
        $rows = $db->fetchRows($sql, array(
            "id"
        ));

        $params = $row;

        $checkFirst = true;
        foreach ($rows as $id => $data) {

            $params['data'][$id]["isfirst"] = false;

            if ($checkFirst) {
                $params['data'][$id]["isfirst"] = true;
                $checkFirst = false;
            }
            $params['data'][$id]["name"] = $data['name'];
            $params['data'][$id]['attrs'] = json_decode($data['description'], 1);
            $params['data'][$id] = self::processParams($row['widget_type'], $params['data'][$id]);
        }
        $params = self::processAttrs($row, $params);
        // review karna hai
        return self::loadWidget($row['widget_type'], $params);
    }

    function registerConfigField($name, $type, $col = 6)
    {
        $this->configFields[] = $this->getField($name, $type, $col);
    }

    function getConfigFields()
    {
        return $this->configFields;
    }

    static function getWidgetConfigFields($widget)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $file = "include/vjlib/libs/bootstrap4/widgets/" . $widget . "/" . $widget . "Widget.php";

        $isFound = false;
        if (file_exists($file)) {
            $isFound = true;
        } else {
            $file = $vjconfig['basepath'] . 'include/entrypoints/site/widgets/' . $vjconfig['sitetpl'] . "/" . $widget . "/" . $widget . "Widget.php";
            if (file_exists($file)) {
                $isFound = true;
            }
        }

        if ($isFound) {
            require_once $file;

            $class = $widget . 'Widget';
            $ob = new $class();
            return $ob->configFields;
        } else {
            return false;
        }
    }

    function loadresource($type, $relativefilepath, $version = 1)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $widgetfolder = $this->module;
        $datawrapper = lib_datawrapper::getInstance();
        $widgetdatawrapper = $datawrapper->get("widget_data_wrapper");
        if (! $widgetdatawrapper) {
            $widgetdatawrapper = array();
        }
        $counter = 0;

        $path = 'resources/widget/modules/' . $widgetfolder . "/" . $relativefilepath;
        if (! file_exists($vjconfig['basepath'] . $path)) {
            $path = 'spider-php/' . $path;
        }
        if (isset($widgetdatawrapper['resources'][$path])) {
            $counter = $widgetdatawrapper['resources'][$path]['counter'] + 1;
        }
        if (file_exists($vjconfig['basepath'] . $path)) {
            $widgetdatawrapper['resources'][$path]['counter'] = $counter;
            $widgetdatawrapper['resources'][$path]['type'] = $type;
            $widgetdatawrapper['resources'][$path]['version'] = $version;
            $datawrapper->set("widget_data_wrapper", $widgetdatawrapper);
        }
    }
}
?>