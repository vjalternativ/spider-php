<?php

class lib_datawrapper
{

    private $data = array();

    private static $instance = null;

    function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new lib_datawrapper();
        }
        return self::$instance;
    }

    public function set($key, $value, $secondaryvalue = null)
    {
        $secondaryvalue == null ? $this->data[$key] = $value : $this->data[$key][$value] = $secondaryvalue;
    }

    public function get($key, $secondaryKey = false)
    {
        return $secondaryKey ? (isset($this->data[$key][$secondaryKey]) ? $this->data[$key][$secondaryKey] : false) : (isset($this->data[$key]) ? $this->data[$key] : false);
    }

    public function getAll()
    {
        return $this->data;
    }
}
?>