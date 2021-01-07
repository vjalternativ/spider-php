<?php
abstract class lib_singleton {

    protected static $instance =  null;


    public static function getInstance() {

        $class = get_called_class();

        if(self::$instance ==null) {
            self::$instance = new $class;
        }
        return self::$instance;
    }



}
?>