<?php

class lib_common
{

    function init($configPath)
    {
        $dir = __DIR__ . '/';
        require_once $dir . 'lib_logger.php';
        require_once $dir . 'lib_config.php';
        lib_config::setConfigPath($configPath);
        $config = lib_config::getInstance()->get("database");
        require_once $dir . 'lib_datawrapper.php';
        require_once $dir . 'lib_database.php';
        require_once $dir . 'lib_entity.php';

        if ($config) {
            $database = lib_database::getInstance();
            $disableDb = lib_config::getInstance()->get("disabledb");
            if (! $disableDb) {
                try {
                    $database->connect($config['host'], $config['user'], $config['password'], $config['name']);
                } catch (Exception $e) {
                    throw new Exception(print_r($config, 1));
                }
            }
        }
    }
}

?>