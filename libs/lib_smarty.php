<?php
$dir = __DIR__.'/';
require_once $dir.'../include/Smarty/Smarty.class.php';
class lib_smarty {

    private static $instance = null;


    static function getSmartyInstance() {
        if(self::$instance==null) {
            self::$instance = new Smarty();
        }
        return self::$instance;
    }



}
?>