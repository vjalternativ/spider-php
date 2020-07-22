<?php 
class server_preference_storeLogicHook {
    function afterSave(&$data) {
        $entity = Entity::getInstance();
        $entity->generateCache();
    }
}
?>