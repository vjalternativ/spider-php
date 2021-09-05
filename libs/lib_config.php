<?php

class lib_config
{

    private static $instance = null;

    private $config;

    function __construct($configPath)
    {
        $dir = __DIR__;
        $fwbasepath = str_replace("libs", "", $dir);
        if (isset($_SERVER['argv'])) {
            if (substr($_SERVER['SCRIPT_FILENAME'], 0, 1) == "/") {
                $dir = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], "/")) . '/';
            } else {
                $path = $_SERVER['PWD'] . '/' . $_SERVER['SCRIPT_FILENAME'];
                $dir = substr($path, 0, strrpos($path, "/")) . '/';
            }
        } else if (isset($_SERVER['SCRIPT_FILENAME'])) {
            $dir = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], "/")) . '/';
        }

        if ($configPath) {
            $dir = $configPath . '/';
        }
        global $config;
        if (file_exists($dir . 'config.php')) {
            if (! isset($_GET['module']) && isset($_SERVER['argv']) && file_exists($dir . "cliconfig.php")) {
                global $cliconfig;
                require_once $dir . 'cliconfig.php';
                $clipath = substr($dir, 0, - 1);
                $_SERVER['HTTP_HOST'] = isset($cliconfig[$clipath]['host']) ? $cliconfig[$clipath]['host'] : "localhost";
            }
            require_once $dir . 'config.php';
            $this->config = $config;
            $this->config['display_errors'] = isset($this->config['display_errors']) ? $this->config['display_errors'] : false;
            ini_set("display_errors", $this->config['display_errors']);
            $this->config['fwbasepath'] = $fwbasepath;
            $this->config['basepath'] = $dir;
            $this->config['resource_alias']['backend'] = isset($this->config['resource_alias']['backend']) ? $this->config['resource_alias']['backend'] : 'backend';
            $this->config['defaultlang'] = isset($config['defaultlang']) ? $config['defaultlang'] : "en_us";
            $this->config['init_default_modules'] = isset($config['init_default_modules']) ? $config['init_default_modules'] : "true";
        } else {
            echo $dir . "config.php" . PHP_EOL;
            $server = $_SERVER;
            $err = print_r($server, 1);
            throw new \ErrorException($dir . " config.php not exist");
        }
    }

    static function getInstance($configPath = false)
    {
        if (self::$instance == null) {
            self::$instance = new lib_config($configPath);
        }
        return self::$instance;
    }

    function get($key)
    {
        return isset($this->config[$key]) ? $this->config[$key] : false;
    }

    function getConfig()
    {
        return $this->config;
    }
}
?>