<?php
require_once __DIR__ . '/libs/lib_framework.php';

class SpiderCronFramework extends lib_framework
{

    private $sessionName;

    function __construct($path, $sessionName = false)
    {
        $this->configpath = $path;
        $_REQUEST['spiderphp_mode'] = 'CRON';
        $_GET['resource'] = 'cli';
        $this->sessionName = $sessionName;
        global $cliconfig;
        require_once $path . '/cliconfig.php';
        if (isset($cliconfig[$path])) {
            $_SERVER['HTTP_HOST'] = $cliconfig[$this->configpath]['host'];
            $_GET['module'] = "cron";
            parent::__construct($path, $sessionName);
        }
    }

    function execute()
    {
        $lockpath = lib_config::getInstance()->get("storage_basepath") . 'locks/';

        if (! is_dir($lockpath)) {
            $cmd = "mkdir -p " . $lockpath;
            shell_exec($cmd);
        }
        $lockfile = $lockpath . "cronlock.lock";

        $lockfilehandle = fopen($lockfile, 'w');
        if ($lockfilehandle === false) {
            exit("Unable to create/open lock file\n");
        }

        if (! flock($lockfilehandle, LOCK_EX | LOCK_NB)) {
            exit("Lock already in use by another process\n");
        }

        echo "Lock file acquired -> Running\n";

        if ($this->configpath) {
            parent::execute();
        } else {
            echo "cronpath not set at " . $this->configpath . " \n";
        }
        echo "Lock file released -> Done\n";
        fclose($lockfilehandle);
    }
}
?>