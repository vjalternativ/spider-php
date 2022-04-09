<?php

class ReportElement
{

    private $key;

    private $value;

    function __construct($key, $val)
    {
        $this->key = $key;
        $this->value = $val;
    }

    /**
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     *
     * @param mixed $val
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
?>