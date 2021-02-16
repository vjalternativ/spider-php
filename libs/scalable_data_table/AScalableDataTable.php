<?php
$path = __DIR__.'/';
require $path.'IScalableDataTable.php';

abstract class AScalableDataTable implements IScalableDataTable {

    private $fieldList = array();
    private $dataTablePrefix = "";
    private $fieldsPerTable = 20;
    private $defaultField = null;
    /**
     * @return mixed
     */
    public function getDefaultField()
    {
        return $this->defaultField;
    }

    /**
     * @param mixed $defaultField
     */
    public function setDefaultField($defaultField)
    {
        $this->defaultField = $defaultField;
    }

    /**
     * @return number
     */
    public function getFieldsPerTable()
    {
        return $this->fieldsPerTable;
    }

    /**
     * @param number $fieldsPerTable
     */
    public function setFieldsPerTable($fieldsPerTable)
    {
        $this->fieldsPerTable = $fieldsPerTable;
    }

    /**
     * @return mixed
     */
    public function getFieldList()
    {
        return $this->fieldList;
    }

    /**
     * @return mixed
     */
    public function getDataTablePrefix()
    {
        return $this->dataTablePrefix;
    }

    /**
     * @param mixed $fieldList
     */
    public function setFieldList($fieldList)
    {
        $this->fieldList = $fieldList;
    }

    /**
     * @param mixed $dataTablePrefix
     */
    public function setDataTablePrefix($dataTablePrefix)
    {
        $this->dataTablePrefix = $dataTablePrefix;
    }

    private function _getDataTables()
    {
        $fieldList = $this->getFieldList();
        $fieldsPerTable = $this->getFieldsPerTable();
        $counter  = 1;
        $tablecounter = 1;
        $tableVsFields = array();
        foreach($fieldList as $key => $field) {
            if($counter <= $fieldsPerTable) {
                $tableVsFields[$this->getDataTablePrefix().'_'.$tablecounter][$key] =  $field;
            }
            if($counter==$fieldsPerTable) {
                $counter = 1;
                $tablecounter ++;
                continue;
            }

            $counter++;
        }
        return $tableVsFields;
    }


    abstract function isTableExistInDatabase($table);
    abstract function isFieldExistInTable($field,$table);
    abstract function generateTable($table);
    abstract function generateTableField(DBField $field,$table);

    private function _processDataTablesInDatabase($tables) {

        foreach($tables as $table) {
            if(!$this->isTableExistInDatabase($table)) {
                    $this->generateTable($table);
            }
        }
    }

    private function _processDataTableField(DBField $field,$table) {
        $fieldExistInTable = $this->isFieldExistInTable($field->getName(), $table);
        if(!$fieldExistInTable) {
            $this->generateTableField($field, $table);
        }
    }

    public function processDataTableForFields()
    {
        if($this->getFieldList() == null) {
            throw new Exception("fieldlist should not be null");
        }
        if($this->getDataTablePrefix() == null) {
            throw new Exception("data table prefix should not be null");
        }
        if($this->getDefaultField() == null) {
            throw new Exception("defaul field should not be null");
        }

        $tableVsFields = $this->_getDataTables();
        $tables = array_keys($tableVsFields);
        $this->_processDataTablesInDatabase($tables);
        foreach($tableVsFields as $table=>$fields) {
            foreach($fields as $field) {
                $field = DBField::as($field);
                $field->setTable($table);
                $this->_processDataTableField($field, $table);
            }
        }
        return $tableVsFields;


    }


    protected static function as(IScalableDataTable $ob) {
        return $ob;
    }



}
?>