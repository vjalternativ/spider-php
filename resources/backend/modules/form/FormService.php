<?php

class FormService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new FormService();
        }
        return self::$instance;
    }

    function getFormHTML()
    {}
}
?>