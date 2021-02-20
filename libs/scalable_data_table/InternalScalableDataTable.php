<?php
use spider\libs\lib_database;

$path = __DIR__.'/';

require_once $path.'AScalableDataTable.php';

 class InternalScalableDataTable extends AScalableDataTable {
    public function isFieldExistInTable($field, $table)
    {
            return lib_database::getInstance()->fieldExist($field, $table);
    }

    public function generateTable($table)
    {
        return lib_database::getInstance()->createTable($table,$this->getDefaultFields());
    }

    public function isTableExistInDatabase($table)
    {
        return lib_database::getInstance()->tableExist($table);
    }

    public function generateTableField(DBField $field, $table)
    {
        return lib_database::getInstance()->addColumn($field, $table);
    }


}

?>