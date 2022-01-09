<?php

class BSFormService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new BSFormService();
        }
        return self::$instance;
    }

    public function createBSField($name, $type, $size = 6)
    {
        $field = array(
            "label" => $name,
            "type" => $type,
            "gridsize" => $size
        );

        return $field;
    }
}
?>