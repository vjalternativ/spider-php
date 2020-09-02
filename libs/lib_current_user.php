<?php
class lib_current_user {
    private static $instance = null;


    static function getEntityInstance() {
        if(self::$instance==null) {
            return  self::sessionCheck('current_user');
        }
        return self::$instance;
    }

    static function sessionCheck($var) {

        if(!isset($_SESSION[$var])) {
            return null;
        }
        if($var =='current_user') {
            $array = json_decode($_SESSION[$var],1);
             $user = new lib_entity();

            foreach($array as $key=>$val) {
                $user->$key = $val;
            }
            self::$instance  = $user;
            return self::$instance;
         }
         return  $_SESSION[$var];


    }



}
?>