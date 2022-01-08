<?php

abstract class RowProcessHook
{

    private $object;

    private $method;

    private $enumList = array();

    public $processHook = array();

    private $firstRowMarker = false;

    private $processSeq = false;

    private $dimIndexer = array();

    /**
     *
     * @return <multitype:, unknown>
     */
    public function getEnumList()
    {
        return $this->enumList;
    }

    /**
     *
     * @param
     *            Ambigous <multitype:, unknown> $enumList
     */
    public function setEnumList($enumList)
    {
        $this->enumList = $enumList;
    }

    /**
     *
     * @return boolean
     */
    public function getProcessSeq()
    {
        return $this->processSeq;
    }

    /**
     *
     * @param boolean $processSeq
     */
    public function setProcessSeq($processSeq)
    {
        $this->processSeq = $processSeq;
    }

    /**
     *
     * @return boolean
     */
    public function getFirstRowMarker()
    {
        return $this->firstRowMarker;
    }

    /**
     *
     * @param boolean $firstRowMarker
     */
    public function setFirstRowMarker($firstRowMarker)
    {
        $this->firstRowMarker = $firstRowMarker;
    }

    abstract function processRow($row);

    public function setDimIndexer($dimIndexer)
    {
        $this->dimIndexer = $dimIndexer;
    }

    public function getDimIndexer()
    {
        return $this->dimIndexer;
    }
}
?>