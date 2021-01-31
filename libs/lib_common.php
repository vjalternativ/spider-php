<?php
class lib_common {



    function init($configPath) {
        $dir = __DIR__.'/';
        require_once $dir.'lib_logger.php';
        require_once $dir.'lib_config.php';
        require_once $dir.'lib_datawrapper.php';
        require_once $dir.'lib_database.php';
        require_once $dir.'lib_entity.php';

        $database = lib_database::getInstance();
        $config = lib_config::getInstance($configPath)->get("database");
        $database->connect($config['host'],$config['user'],$config['password'],$config['name']);

    }

}

?>