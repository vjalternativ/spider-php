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

    public function set($key, $val, $index = null)
    {
        $value = $val;
        if ($index) {
            $data = $this->get($key);
            $data = $data ? $data : array();
            $data[$index] = $val;
            $value = $data;
        }
        $_SESSION[$key] = $value;
    }

    public function unset($key, $index = null)
    {
        if ($index) {

            if (isset($_SESSION[$key][$index])) {
                unset($_SESSION[$key][$index]);
            }
        } else {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    }
}
?>