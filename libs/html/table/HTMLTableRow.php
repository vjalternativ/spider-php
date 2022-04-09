<?php
require_once __DIR__ . '/HTMLTableCell.php';
require_once __DIR__ . '/HTMLImgTableCell.php';

class HTMLTableRow extends HTMLElementDual
{

    private $cellList = array();

    private $rowmaxcell = 0;

    function __construct()
    {
        parent::__construct("tr");
    }

    function addTableCell(HTMLTableCell $cell)
    {
        $this->cellList[] = $cell;
    }

    public function buildContent()
    {
        foreach ($this->cellList as $cell) {
            $cell = $this->asHTMLElement($cell);
            $this->appendContent($cell->getHTML());
        }

        $left = $this->rowmaxcell - count($this->cellList);

        for ($i = 0; $i < $left; $i ++) {
            $cell = new HTMLTableCell("");
            $this->appendContent($cell->getHTML());
        }
    }

    public function getLength()
    {
        return count($this->cellList);
    }

    public function setRowMaxCells($count)
    {
        $this->rowmaxcell = $count;
    }
}
?>