<?php

class ServerPreferenceStoreService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ServerPreferenceStoreService();
        }
        return self::$instance;
    }

    function get($key)
    {
        $serverPreferenceStore = lib_datawrapper::getInstance()->get("server_preference_store_list");

        if (isset($serverPreferenceStore[$key])) {

            return $serverPreferenceStore[$key]['description'];
        } else {
            throw new Exception("key " . $key . " not exist");
        }
    }
}
?>