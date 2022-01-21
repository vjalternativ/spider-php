<?php
require_once lib_config::getInstance()->get('fwbasepath') . 'resources/cli/modules/cron/CronService.php';

class cronprocessCliController extends CliResourceController
{

    private function processJobData($jobdata)
    {
        if ($jobdata) {

            $entity = lib_entity::getInstance();
            $jobdata['jobstatus'] = "started";
            $entity->save("scheduler", $jobdata);

            $path = $jobdata['path'];
            $module = $jobdata['module'];
            $method = $jobdata['method'];
            if ($module && $method) {

                $modules = CronService::getInstance()->getCronModules();
                if (isset($modules[$module])) {
                    $moduleData = $modules[$module];
                    $filepath = $moduleData['filepath'];
                    require_once $filepath;
                    $class = $module . 'CliController';
                    $ob = new $class();
                    $method = 'action_' . $method;
                    $ob->$method();
                    $this->echo("cronprocess completed");
                }
            } else if ($path) {
                if (file_exists($path)) {
                    require_once $path;
                    $class = $jobdata['jobclass'];
                    $ob = new $class();
                    $ob->execute();
                    $this->echo("cronprocess completed");
                } else {
                    $this->echo("invalid job filepath " . $path);
                }
            } else {
                $this->echo("invalid job filepath : empty");
            }

            $this->markCompleted($jobdata);
        }
    }

    function action_force()
    {
        $module = $this->getarg(3);
        $method = $this->getarg(4);
        if ($module) {

            $sql = "select * from scheduler where deleted=0  and status='Active' ";

            if ($method) {
                $sql .= " and module='" . $module . "' and  method='" . $method . "' ";
            } else {
                $sql .= " and jobclass='" . $module . "' ";
            }

            $jobdata = lib_database::getInstance()->getrow($sql);

            if ($jobdata) {

                $this->processJobData($jobdata);
            } else {
                $this->echo("invalid job class/module and method");
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
        $sql .= " order by date_modified asc";

        $rows = $db->getAll($sql);
        foreach ($rows as $jobdata) {
            $jobdata = $db->getrow($sql);
            $this->processJobData($jobdata);
        }
    }

    function markCompleted($jobdata)
    {
        $entity = lib_entity::getInstance();
        $jobdata['jobstatus'] = "completed";
        $entity->save("scheduler", $jobdata);
    }
}

?>