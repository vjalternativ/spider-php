<?php
class lib_current_user {
    private static $instances = array();
    static function getEntityInstance($resource="default") {

        if($resource=="default") {
            $resource = $_GET["resource"];
        }
        if(isset(self::$instances[$resource])) {
            return self::$instances[$resource];
        } else {
            $user =  self::sessionCheck($resource);
            if($user) {
                self::$instances[$resource] = $user;
                return self::$instances[$resource];
            } else {
                return  null;
            }
        }
        return null;
    }

    static function sessionCheck($resource="default") {
        if($resource=="default") {
                $resource = $_GET['resource'];
        }
        $var= $resource."_current_user";
        if(!isset($_SESSION[$var])) {
            return null;
        }
        $array = json_decode($_SESSION[$var],1);
        $user = new lib_entity();
        foreach($array as $key=>$val) {
            $user->$key = $val;
        }
        self::$instances[$resource] = $user;
        return $user;


    }



}
?>