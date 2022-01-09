<?php

class lib_session
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new lib_session();
        }
        return self::$instance;
    }

    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
}
?>