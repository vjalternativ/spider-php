<?php
class lib_current_user {
    private static $instance = null;


    static function getEntityInstance() {
        if(self::$instance==null) {
            self::$instance = new lib_entity();
        }
        return self::$instance;
    }

    static function sessionCheck($var) {

        if(!isset($_SESSION[$var])) {
            return false;
        }
        if($var =='current_user') {
            $array = json_decode($_SESSION[$var],1);
             $user = self::getEntityInstance();

            foreach($array as $key=>$val) {
                $user->$key = $val;
            }
            return self::$instance;
         }
         return  $_SESSION[$var];


    }



}
?>