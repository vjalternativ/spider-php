<?php 
class tableinfo_language_m_mLogicHook {
    
    function afterSave(&$keyvalue) {
        global $globalEntityList,$entity;
               $tablename = $globalEntityList[$keyvalue['tableinfo_id']]['name'];
               $langugage = $entity->get("language",$keyvalue['language_id']);
               $tablename .= '_'.strtolower($langugage['name']);
               if(!isset($globalModuleList[$tablename])) {
                    $entity->createEntity($tablename);    
               }
    }
     
                 
}

?>