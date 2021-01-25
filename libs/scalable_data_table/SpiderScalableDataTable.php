<?php

$path = __DIR__.'/';
require_once $path.'AScalableDataTable.php';
abstract class SpiderScalableDataTable extends AScalableDataTable
{

    public function isFieldExistInTable($field, $table)
    {
        $moduleList = lib_datawrapper::getInstance()->get("module_list");
        return isset($moduleList[$table]['tableinfo']['fields'][$field]);

    }

    public function generateTable($table)
    {
        lib_entity::getInstance()->createEntity($table);
    }

    public function isTableExistInDatabase($table)
    {
            $moduleList = lib_datawrapper::getInstance()->get("module_list");
            return isset($moduleList[$table]);
    }

    public function generateTableField(DBField $field, $table)
    {
            lib_entity::getInstance()->addField($table, $field);
    }

}
?>