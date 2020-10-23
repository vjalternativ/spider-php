<?php
class tableinfoLogicHook {


    function beforeSave(&$keyvalue) {
          $keyvalue = lib_entity::getInstance()->updateTableinfoEntity($keyvalue);
    }

    function afterSave(&$keyvalue) {
        $entity = lib_entity::getInstance();
        lib_entity::getInstance()->updateTableinfoEntity($keyvalue['name'], $keyvalue['tabletype']);

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