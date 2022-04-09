<?php
require_once __DIR__ . '/../html/table/HTMLTable.php';
require_once __DIR__ . '/ReportRow.php';

class ReportTable extends HTMLTable
{

    function __construct()
    {
        parent::__construct(1, 5);
        $this->setAttribute("width", "100%");
    }

    function addReportRow(ReportRow $tableRow)
    {
        $this->addTableRow($tableRow);
    }
}

