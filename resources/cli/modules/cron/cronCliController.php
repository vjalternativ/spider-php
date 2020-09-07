<?php
class cronCliController extends CliResourceController {

    var $jobs = array();
    function action_index() {

        $db = lib_mysqli::getInstance();
        $sql = "select now() as nowdate,scheduler.* from scheduler where deleted=0 and status='Active'   order by date_modified asc";
        $rows = $db->fetchRows($sql,array("id"));
        $this->jobs = $rows;
        if($rows)
        $this->process();
    }

    function isvalid($jobdata) {
        if($jobdata['jobstatus'] == "started") {
            return false;
        }
        $today = new DateTime($jobdata['nowdate']);
        $dateModified = $jobdata['date_modified'];
        $date = new DateTime($dateModified);

        $diffmin = ($today->getTimestamp() - $date->getTimestamp()) / 60;

        if($diffmin < $jobdata['inminute']) {
            return false;
        }

        //$jobdata['jobstatus'] = "started";
        //$entity->save("scheduler",$jobdata);
        return true;

    }

    function process() {
        $entity  = lib_entity::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        foreach($this->jobs as $key => $jobdata) {
            if(!$this->isvalid($jobdata)) {
                unset($this->jobs[$key]);
            }
         }
         if($this->jobs) {
             foreach($this->jobs as $jobdata) {
                 $jobdata['jobstatus'] = "pending";
                 $entity->save("scheduler",$jobdata);
             }
             shell_exec("php ".$vjconfig['basepath']."cronthread.php > /dev/null 2>/dev/null &");
         }

    }


    function processJob($jobdata) {
        $vjconfig = lib_config::getInstance()->getConfig();
        if(isset($jobdata['path'])) {

            file_put_contents("locks/thread.json", json_encode($jobdata));
            shell_exec("php ".$vjconfig['basepath']."cronthread.php > /dev/null 2>/dev/null &");
            sleep(1);

            // shell_exec("php ".$vjconfig['basepath'].'cronprocessor.php '.$jobdata['id']." ".$jobdata['path'].' '.$jobdata['class']." > /dev/null 2>/dev/null &");
            /*  require_once $jobdata['path'];
            $class= $jobdata['jobclass'];


            $ob = new $class();
            $ob->execute();
            $jobdata['jobstatus'] = "completed";
            $entity->save("scheduler",$jobdata); */

        }


    }
}
?>