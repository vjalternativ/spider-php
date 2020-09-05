<?php
require_once __DIR__.'/libs/lib_framework.php';
class SpiderCronThreadFramework extends lib_framework {

    function __construct($sessionName=false) {

            $_REQUEST['spiderphp_mode'] = 'CRONTHREAD';
            $_GET['resource'] = 'cli';
            parent::__construct($sessionName);
    }

    function execute() {

        global $cronconfig;
        $lockfile = $this->configpath.'/locks/cronthread.lock';
        $lockfilehandle = fopen ( $lockfile, 'w' );
        if ($lockfilehandle === false) {
            exit ( "Unable to create/open lock file\n" );
        }

        if (! flock ( $lockfilehandle, LOCK_EX | LOCK_NB )) {
            exit ( "Lock already in use by another process\n" );
        }

        echo "Lock file acquired -> Running\n";

        require_once $this->configpath.'/cronconfig.php';

        if(isset($cronconfig[$this->configpath])) {
            $_SERVER['HTTP_HOST'] = $cronconfig[$this->configpath]['host'];
            $_REQUEST['entryPoint'] = "cronprocess";
            $_GET['module'] = "cronprocess";

            parent::execute();
        } else {
            echo "cronpath not set at ".$this->configpath." \n";
        }
        echo "Lock file released -> Done\n";
        fclose ( $lockfilehandle );

    }

}
?>