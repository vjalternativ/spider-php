<?php 
class tableinfoLogicHook {
    
    function afterSave(&$keyvalue) {
        $entity = lib_entity::getInstance();
        if($keyvalue['hook_isnew'] && $keyvalue['tabletype']=="user") {
            $id = $keyvalue['id'];
            $data = array();
            $data['name'] = $keyvalue['name'];
            $data['id'] = $id;
            $data['new_with_id'] = true;
            $entity->save("roles",$data);
        }
    }
}
?>