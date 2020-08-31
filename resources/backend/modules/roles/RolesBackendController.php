<?php
class RolesBackendController extends BackendResourceController {
    
    function action_saveAccess() {
        $db = lib_mysqli::getInstance();
	    global $entity;
        $record = $_POST['record'];
        $sql = "delete from roles_item where role_id='".$record."'";
        $db->query($sql);
        $keyvalue=array();
        foreach($_POST['module_access'] as $moduleId) {
            $keyvalue['module_id']  = $moduleId;
            $keyvalue['role_id']  = $record;
            $keyvalue['module_access']  = "yes";
            $entity->save("roles_item",$keyvalue);
        }
        $params  =array();
        $params['record'] = $record;
        redirect("roles","detailview",$params);
        
    }
}