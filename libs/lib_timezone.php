<?php

class lib_timezone
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new lib_timezone();
        }
        return self::$instance;
    }

    function utcToTimezone($datetime)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $serverTimeZone = "UTC";
        if (isset($vjconfig['server_timezone'])) {
            $serverTimeZone = $vjconfig['server_timezone'];
        }
        $given = new DateTime($datetime, new DateTimeZone($serverTimeZone));
        $given->setTimezone(new DateTimeZone($vjconfig['timezone']));
        return $given->format("Y-m-d H:i:s");
    }

    function processDefaultFields($row)
    {
        if (isset($row['date_entered'])) {
            $row['date_entered'] = $this->utcToTimezone($row['date_entered']);
        }
        if (isset($row['date_modified'])) {
            $row['date_modified'] = $this->utcToTimezone($row['date_modified']);
        }
        return $row;
    }
}
?>