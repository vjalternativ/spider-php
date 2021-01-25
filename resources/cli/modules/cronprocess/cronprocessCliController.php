<?php
global $jobdata;

class cronprocessCliController extends CliResourceController {
    function action_index() {
        $db = lib_database::getInstance();
        $sql = "select * from scheduler where deleted=0  and status='Active'  and ";
        global $jobdata;
        $jobdata=array();
        if(isset($_SERVER['argv'][1])) {
            $sql.= " id = '".$_SERVER['argv'][1]."'" ;
        } else {
            $sql.= " jobstatus='pending' ";
        }
        $sql .= " order by date_modified asc limit 1";
        $jobdata = $db->getrow($sql);

        if($jobdata) {
            register_shutdown_function('shutdown');



            $entity =lib_entity::getInstance();
            $jobdata['jobstatus'] = "started";
            $entity->save("scheduler",$jobdata);

            require_once $jobdata['path'];
            $class= $jobdata['jobclass'];
            $ob = new $class();
            $ob->execute();
        }

        /*
        global $entity,$log;
        $jobdata =array();
        if(isset($_REQUEST['debug'])) {
            $jobdata['id'] = $_REQUEST['jobid'];
            $jobdata['path'] = $_REQUEST['jobpath'];
            $jobdata['jobclass']  = $_REQUEST['jobclass'];
        } else {
            $json = file_get_contents("locks/thread.json");
            $jobdata = json_decode($json,1);

        }

        require_once $jobdata['path'];
        $class= $jobdata['jobclass'];
        $ob = new $class();
        $ob->execute();
        $jobdata['jobstatus'] = "completed";

        $entity->save("scheduler",$jobdata);
         */
    }
}

function shutdown() {
    global $jobdata;
    $entity =lib_entity::getInstance();
    $vjconfig = lib_config::getInstance()->getConfig();
    $jobdata['jobstatus'] = "completed";
    $entity->save("scheduler",$jobdata);
    shell_exec("php ".$vjconfig['basepath']."cronthread.php > /dev/null 2>/dev/null &");
}
?>