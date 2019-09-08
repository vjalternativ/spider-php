<?php 




global $db,$jobdata;

$sql = "select * from scheduler where deleted=0  and status='Active' and jobstatus='pending'  order by date_modified asc limit 1";
$jobdata = $db->getrow($sql);


function shutdown() {
    global $jobdata,$entity,$vjconfig;
    $jobdata['jobstatus'] = "completed";
    $entity->save("scheduler",$jobdata);
    shell_exec("php ".$vjconfig['basepath']."cronthread.php > /dev/null 2>/dev/null &");    
}


if($jobdata) {
    register_shutdown_function('shutdown');
    
    global $jobdata,$entity;
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

?>