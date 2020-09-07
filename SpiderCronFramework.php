<?php
require_once __DIR__.'/libs/lib_framework.php';
class SpiderCronFramework extends lib_framework {


    private $sessionName;
    function __construct($path,$sessionName=false) {
            $_REQUEST['spiderphp_mode'] = 'CRON';
            $_GET['resource'] = 'cli';
            $this->sessionName = $sessionName;
            global $cronconfig;
            require_once $path.'/cronconfig.php';
            if(isset($cronconfig[$path])) {
                $this->configpath = $path;
                $_SERVER['HTTP_HOST'] = $cronconfig[$this->configpath]['host'];
                $_GET['module'] = "cron";
                parent::__construct($path,$sessionName);
            }
    }

    function execute() {



        $lockfile = $this->configpath.'/locks/cronlock.lock';
        $lockfilehandle = fopen ( $lockfile, 'w' );
        if ($lockfilehandle === false) {
            exit ( "Unable to create/open lock file\n" );
        }

        if (! flock ( $lockfilehandle, LOCK_EX | LOCK_NB )) {
            exit ( "Lock already in use by another process\n" );
        }

        echo "Lock file acquired -> Running\n";

        if($this->configpath) {
            parent::execute();
        } else {
            echo "cronpath not set at ".$this->configpath." \n";
        }
        echo "Lock file released -> Done\n";
        fclose ( $lockfilehandle );

    }

}
?>