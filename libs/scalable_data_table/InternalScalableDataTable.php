<?php
require_once 'libs/scalable_data_table/AScalableDataTable.php';

 class InternalScalableDataTable extends AScalableDataTable {
    public function isFieldExistInTable($field, $table)
    {
            return lib_database::getInstance()->fieldExist($field, $table);
    }

    public function generateTable($table)
    {
        return lib_database::getInstance()->createTable($table);
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