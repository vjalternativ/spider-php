<?php

class cronprocessCliController extends CliResourceController
{

    private function processJobData($jobdata)
    {
        if ($jobdata) {
            register_shutdown_function('shutdown', $jobdata);

            $entity = lib_entity::getInstance();
            $jobdata['jobstatus'] = "started";
            $entity->save("scheduler", $jobdata);

            require_once $jobdata['path'];
            $class = $jobdata['jobclass'];
            $ob = new $class();
            $ob->execute();
        }
    }

    function action_force()
    {
        $jobClass = $this->getarg(3);

        if ($jobClass) {
            $sql = "select * from scheduler where deleted=0  and status='Active'  and jobclass='" . $jobClass . "'";
            $jobdata = lib_database::getInstance()->getrow($sql);

            if ($jobdata) {

                $this->processJobData($jobdata);
            } else {
                $this->echo("invalid job class");
            }
        } else {
            $this->echo("specify jobclass");
        }
    }

    function action_index()
    {
        $db = lib_database::getInstance();
        $sql = "select * from scheduler where deleted=0  and status='Active'  and ";
        $sql .= " jobstatus='pending' ";
        $sql .= " order by date_modified asc limit 1";
        $jobdata = $db->getrow($sql);
        $this->processJobData($jobdata);

        /*
         * global $entity,$log;
         * $jobdata =array();
         * if(isset($_REQUEST['debug'])) {
         * $jobdata['id'] = $_REQUEST['jobid'];
         * $jobdata['path'] = $_REQUEST['jobpath'];
         * $jobdata['jobclass'] = $_REQUEST['jobclass'];
         * } else {
         * $json = file_get_contents("locks/thread.json");
         * $jobdata = json_decode($json,1);
         *
         * }
         *
         * require_once $jobdata['path'];
         * $class= $jobdata['jobclass'];
         * $ob = new $class();
         * $ob->execute();
         * $jobdata['jobstatus'] = "completed";
         *
         * $entity->save("scheduler",$jobdata);
         */
    }
}

function shutdown($jobdata)
{
    $entity = lib_entity::getInstance();
    $vjconfig = lib_config::getInstance()->getConfig();
    $jobdata['jobstatus'] = "completed";
    $entity->save("scheduler", $jobdata);
    shell_exec("php " . $vjconfig['basepath'] . "index.php cronprocess > /dev/null 2>/dev/null &");
}
?>