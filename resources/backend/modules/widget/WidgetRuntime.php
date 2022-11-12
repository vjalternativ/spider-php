<?php

class WidgetRuntime extends RuntimeBean
{

    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new WidgetRuntime();
        }
        return self::$instance;
    }

    private $widgetConfig = array();

    private function __construct()
    {
        $date = date("Y-m-d");

        $json = $this->load();

        if ($json) {
            if ($date == $json['lastCacheDate']) {
                $this->widgetConfig = $json['widgetConfig'];
            } else {
                $this->write();
            }
        } else {
            $this->write();
        }
    }

    public function write()
    {
        $date = date("Y-m-d");
        $db = lib_database::getInstance();

        $sql = "select * from widget where deleted=0";
        $rows = $db->getAll($sql, array(
            "alias"
        ), "description");

        foreach ($rows as $key => $val) {
            $rows[$key] = json_decode($val, true);
        }

        $this->widgetConfig = $rows;
        $data = array();
        $data['widgetConfig'] = $this->widgetConfig;
        $data['lastCacheDate'] = $date;
        $this->data = $data;
        parent::write();
    }

    public function getConfig($widgetAlias, $key = null)
    {
        if (isset($this->widgetConfig[$widgetAlias])) {

            if ($key) {
                if (isset($this->widgetConfig[$widgetAlias][$key])) {
                    return $this->widgetConfig[$widgetAlias][$key];
                }
                return false;
            }
            return $this->widgetConfig[$widgetAlias];
        }
        return false;
    }

    public function getPath()
    {
        return "WidgetRuntime";
    }
}

?>