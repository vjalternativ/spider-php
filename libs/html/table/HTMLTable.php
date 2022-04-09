<?php
require_once __DIR__ . '/../core/HTMLElementDual.php';
require_once __DIR__ . '/../core/HTMLSpan.php';
require_once __DIR__ . '/HTMLTableRow.php';
require_once __DIR__ . '/../core/HTMLH4.php';

class HTMLTable extends HTMLElementDual
{

    private $tableRowList = array();

    function __construct($border = null, $cellpadding = null, $cellspacing = 0)
    {
        parent::__construct("table");
        $this->setAttribute("border", $border);
        $this->setAttribute("cellpadding", $cellpadding);
        $this->setAttribute("cellspacing", $cellspacing);
    }

    function addTableRow(HTMLTableRow $tableRow)
    {
        $this->tableRowList[] = $tableRow;
    }

    private function asTableRow(HTMLTableRow $ob)
    {
        return $ob;
    }

    public function buildContent()
    {
        $length = 0;
        foreach ($this->tableRowList as $row) {
            $row = $this->asTableRow($row);
            $length = $row->getLength() > $length ? $row->getLength() : $length;
        }

        foreach ($this->tableRowList as $row) {
            $row = $this->asTableRow($row);
            $row->setRowMaxCells($length);
            $row = $this->asHTMLElement($row);
            $this->appendContent($row->getHTML());
        }
    }

    protected function getTableRowList()
    {
        return $this->tableRowList;
    }
}
?>