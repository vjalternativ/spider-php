<?php 
class server_preference_storeLogicHook {
    function afterSave(&$data) {
        $entity = lib_entity::getInstance();
        $entity->generateCache();
    }
}
?>