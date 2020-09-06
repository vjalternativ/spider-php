<?php
class lib_common {



    function init($configPath) {

        $dir = __DIR__.'/';
        require_once $dir.'lib_logger.php';
        require_once $dir.'lib_config.php';
        require_once $dir.'lib_datawrapper.php';
        require_once $dir.'lib_mysqli.php';
        require_once $dir.'lib_entity.php';

        $mysqli = lib_mysqli::getInstance();
        $config = lib_config::getInstance($configPath)->get("mysql");
        $mysqli->connect($config['host'],$config['user'],$config['password'],$config['database']);

    }

}

?>