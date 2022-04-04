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

    public function get($key, $secondaryKey = false)
    {
        return $secondaryKey ? (isset($_SESSION[$key][$secondaryKey]) ? $_SESSION[$key][$secondaryKey] : null) : (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    public function set($key, $value, $secondaryvalue = '__UNDEFINED__')
    {
        if ($secondaryvalue == "photo-signature-form") {
            echo $key . " " . $value . " <br >";
            die();
        }
        if ($secondaryvalue == "__UNDEFINED__") {
            $_SESSION[$key] = $value;
        } else {

            if (array_key_exists($key, $_SESSION)) {
                $data = is_array($_SESSION[$key]) ? $_SESSION[$key] : array();
                $data[$value] = $secondaryvalue;
                $_SESSION[$key] = $data;
            } else {
                $_SESSION[$key] = array();
                $_SESSION[$key][$value] = $secondaryvalue;
            }
        }
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