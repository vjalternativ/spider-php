<?php
namespace spider\beans;

class DBField {
    private $name;
    private $dataType;
    private $default;
    private $length;
    private $index;
    private $table;
    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param mixed $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    function __construct($name,$dataType,$length=null,$default=null,$index=null) {


        $name = trim($name);
        $dataType = trim($dataType);
        if($name && $dataType) {
            $this->name = $name;
            $this->dataType = $dataType;
            $this->length = $length;
            $this->default = $default;
            $this->index = $index;
        } else {
            throw new \Exception("Invalid.DBField name or dataType");
        }
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $dataType
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * @param mixed $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    static function as(DBField $field) {
        return $field;
    }


}
?>