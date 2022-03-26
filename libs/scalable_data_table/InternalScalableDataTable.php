<?php
$path = __DIR__ . '/';

require_once $path . 'AScalableDataTable.php';

abstract class InternalScalableDataTable extends AScalableDataTable
{

    private $fieldMap;

    /**
     *
     * @return mixed
     */
    public function getFieldMap()
    {
        return $this->fieldMap;
    }

    /**
     *
     * @param mixed $fieldMap
     */
    public function setFieldMap($fieldMap)
    {
        $this->fieldMap = $fieldMap;
    }

    public function isFieldExistInTable($field, $table)
    {
        return lib_database::getInstance()->fieldExist($field, $table);
    }

    public function generateTable($table)
    {
        return lib_database::getInstance()->createTable($table, $this->getDefaultFields());
    }

    public function isTableExistInDatabase($table)
    {
        return lib_database::getInstance()->tableExist($table);
    }

    public function generateTableField(DBField $field, $table)
    {
        return lib_database::getInstance()->addColumn($field, $table);
    }

    abstract function writeFieldMap($fieldMap);

    function updateFieldMapJson($tableVsFields)
    {
        foreach ($tableVsFields as $table => $fields) {
            foreach ($fields as $field) {
                $field = DBField::as($field);
                $this->fieldMap[$field->getName()]['table'] = $table;
                if (! isset($this->fieldMap[$field->getName()]['date_modified'])) {
                    $this->fieldMap[$field->getName()]['date_modified'] = date("Y-m-d H:i:s");
                }
            }
        }
        $this->writeFieldMap($this->fieldMap);
    }

    function processDataTableForFieldsAndUpdateFieldMapJson()
    {
        $tableVsFields = $this->processDataTableForFields();
        if ($tableVsFields) {
            $this->updateFieldMapJson($tableVsFields);
        }
    }
}

?>