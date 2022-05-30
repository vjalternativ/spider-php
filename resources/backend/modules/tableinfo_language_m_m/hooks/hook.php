<?php

class tableinfo_language_m_mLogicHook
{

    function afterSave(&$keyvalue)
    {
        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");
        $entity = lib_entity::getInstance();
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");
        $tablename = $globalEntityList[$keyvalue['tableinfo_id']]['name'];
        $langugage = $entity->get("language", $keyvalue['language_id']);
        $tablename .= '_' . strtolower($langugage['name']);
        if (! isset($globalModuleList[$tablename])) {
            $entity->createEntity($tablename);
        }
    }
}

?>