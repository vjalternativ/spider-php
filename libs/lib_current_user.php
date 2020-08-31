<?php
class lib_current_user {
    private static $instance = null;
    static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new lib_current_user();
        }
        return self::$instance;
    }

    function sessionCheck() {
        isset($_SESSION['current_user']) ? $_SESSION['current_user'] : false;
    }



}
?>