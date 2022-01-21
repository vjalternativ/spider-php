<?php

class cronCliController extends CliResourceController
{

    var $jobs = array();

    function __construct()
    {
        parent::__construct();
        $db = lib_database::getInstance();
        $sql = "select now() as nowdate,scheduler.* from scheduler where deleted=0 and status='Active'   order by date_modified asc";
        $rows = $db->fetchRows($sql, array(
            "jobclass"
        ));
        $this->jobs = $rows;
    }

    function action_index()
    {
        if ($this->jobs)
            $this->process();
    }

    function action_force()
    {
        if ($this->jobs)
            $this->process(true);
    }

    function isvalid($jobdata)
    {
        $now = date("Y-m-d H:i:s");

        $starton = $jobdata['start_on'];
        $dateModified = $jobdata['date_modified'];

        if ($starton) {

            if ($now < $starton) {
                return false;
            }

            if ($starton > $dateModified) {
                $jobdata['date_modified'] = $starton;
            }
        }

        if ($jobdata['jobstatus'] == "started") {
            $this->echo("job " . $jobdata['jobclass'] . "already started");

            return false;
        }
        $today = new DateTime($jobdata['nowdate']);
        $date = new DateTime($dateModified);

        $diffmin = ($today->getTimestamp() - $date->getTimestamp()) / 60;

        if ($diffmin < $jobdata['inminute']) {

            $this->echo("job " . $jobdata['jobclass'] . " ignoring as diff " . $diffmin);

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
        $basepath = lib_config::getInstance()->get("basepath");

        shell_exec("php " . $basepath . "index.php cronprocess > /dev/null 2>/dev/null &");
    }

    function process($force = false)
    {
        if ($this->jobs) {

            if ($force) {
                $jobclass = $this->getarg(3);
                if ($jobclass) {

                    if (isset($this->jobs[$jobclass])) {
                        $jobdata = $this->jobs[$jobclass];
                        $this->scheduleJob($jobdata);
                        $this->startCronProcess();
                    } else {
                        $this->echo("invalid jobclass");
                    }
                } else {
                    $this->echo("specify job class");
                }
            } else {

                foreach ($this->jobs as $key => $jobdata) {
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
    }

    function processJob($jobdata)
    {
        $vjconfig = lib_config::getInstance()->getConfig();

        if (isset($jobdata['path'])) {
            file_put_contents("locks/thread.json", json_encode($jobdata));
            shell_exec("php " . $vjconfig['basepath'] . "index.php cronprocess > /dev/null 2>/dev/null &");
            sleep(1);
        }
    }
}
?>