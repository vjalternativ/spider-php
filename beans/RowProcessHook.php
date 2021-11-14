<?php

class RowProcessHook
{

    private $object;

    private $method;

    private $enumList = array();

    public $processHook = array();

    private $firstRowMarker = false;

    private $processSeq = false;

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

    function __construct($object = null, $method = "", $enumList = array())
    {
        $this->object = $object;
        $this->method = $method;
        $this->enumList = $enumList;

        if ($this->object) {

            if ($object) {
                $this->processHook['instance'] = $object;
            }
            if ($method) {
                $this->processHook['method'] = $method;
            }
            if ($enumList) {
                $this->processHook['enumList'] = $enumList;
            }
        }
    }
}
?>