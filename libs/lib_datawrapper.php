<?php
class lib_datawrapper {


    private $data = array();
    private static $instance = null;

    function __construct() {

    }
    public static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new lib_datawrapper();
        }
        return self::$instance;
    }


   public function set($key,$value) {
        $this->data[$key] = $value;
    }

    public function get($key) {

        return isset($this->data[$key]) ? $this->data[$key] : false;
    }

    public function getAll() {
        return $this->data;
    }



}
?>