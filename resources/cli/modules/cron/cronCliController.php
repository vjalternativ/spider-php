<?php

class cronCliController extends CliResourceController
{

    var $jobs = array();

    function __construct()
    {
        parent::__construct();
        $db = lib_database::getInstance();
        $sql = "select now() as nowdate,scheduler.* from scheduler where deleted=0 and status='Active'   order by date_modified asc";
        $rows = $db->fetchRows($sql);
        $this->jobs = $rows;
    }

    function action_index()
    {
        if ($this->jobs)
            $this->process();
    }

    function isvalid($jobdata)
    {
        $now = date("Y-m-d H:i:s");

        $starton = $jobdata['start_on'];
        $dateModified = $jobdata['date_modified'];

        if ($starton) {

            if ($now < $starton) {
                $this->echo("job " . $jobdata['jobclass'] . " " . $jobdata['module'] . " " . $jobdata['method'] . " now is less than start on " . $jobdata['start_on']);
                return false;
            }

            if ($starton > $dateModified) {
                $jobdata['date_modified'] = $starton;
            }
        }

        if ($jobdata['jobstatus'] == "started") {
            $this->echo("job " . $jobdata['jobclass'] . " " . $jobdata['module'] . " " . $jobdata['method'] . " already started");

            return false;
        }
        $today = new DateTime($jobdata['nowdate']);
        $date = new DateTime($dateModified);

        $diffmin = ($today->getTimestamp() - $date->getTimestamp()) / 60;

        if ($diffmin < $jobdata['inminute']) {

            $this->echo("job " . $jobdata['jobclass'] . " " . $jobdata['module'] . " " . $jobdata['method'] . " ignoring as diff " . $diffmin);

            return false;
        }

        // $jobdata['jobstatus'] = "started";
        // $entity->save("scheduler",$jobdata);
        return true;
    }

    private function scheduleJob($jobdata)
    {
        $this->echo("job " . $jobdata['jobclass'] . " scheduling");
        $jobdata['jobstatus'] = "pending";
        lib_entity::getInstance()->save("scheduler", $jobdata);
    }

    private function startCronProcess()
    {
        $config = lib_config::getInstance()->getConfig();
        $basepath = $config['basepath'];

        $config['php_bin'] = isset($config['php_bin']) ? $config['php_bin'] : "php";
        shell_exec($config['php_bin'] . " " . $basepath . "index.php cronprocess > /dev/null 2>/dev/null &");
    }

    function process($force = false)
    {
        if ($this->jobs) {

            foreach ($this->jobs as $key => $jobdata) {
                $this->echo("job " . $jobdata['jobclass'] . " " . $jobdata['module'] . " " . $jobdata['method'] . " checking is valid");

                if (! $this->isvalid($jobdata) && ! $force) {
                    unset($this->jobs[$key]);
                }
            }
            if ($this->jobs) {
                foreach ($this->jobs as $jobdata) {
                    $this->scheduleJob($jobdata);
                }
                $this->startCronProcess();
            }
        }
    }

    function processJob($jobdata)
    {
        $vjconfig = lib_config::getInstance()->getConfig();

        if (isset($jobdata['path'])) {
            file_put_contents($vjconfig['storage_basepath'] . "locks/thread.json", json_encode($jobdata));
            shell_exec("php " . $vjconfig['basepath'] . "index.php cronprocess > /dev/null 2>/dev/null &");
            sleep(1);
        }
    }
}
?>