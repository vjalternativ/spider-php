<?php

class lib_common
{

    function init($configPath)
    {
        $dir = __DIR__ . '/';
        require_once $dir . 'lib_logger.php';
        require_once $dir . 'lib_config.php';
        lib_config::setConfigPath($configPath);
        $config = lib_config::getInstance()->getConfig();
        require_once $dir . 'lib_datawrapper.php';
        require_once $dir . 'lib_database.php';
        require_once $dir . 'lib_entity.php';

        if (isset($config['database'])) {
            $database = lib_database::getInstance();
            $disableDb = lib_config::getInstance()->get("disabledb");
            if (! $disableDb) {
                try {
                    $database->connect($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['name']);
                } catch (Exception $e) {
                    throw new Exception(print_r($config, 1));
                }
            }

            if (isset($config['datasource'])) {
                foreach ($config['datasource'] as $profile => $dbsourceMap) {
                    $dir = __DIR__ . '/';
                    require_once $dir . 'lib_' . $profile . '.php';

                    foreach ($dbsourceMap as $key => $dbsource) {

                        $class = 'lib_' . $profile;
                        $ob = new $class();
                        $ob = lib_database::addDataSource($profile, $key, $ob);

                        $ob->connect($dbsource['host'], $dbsource['user'], $dbsource['password'], $dbsource['name']);
                    }
                }
            }
        }
    }
}

?>