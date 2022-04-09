<?php
require_once __DIR__ . '/ReportElement.php';

class ReportRow extends HTMLTableRow
{

    function __construct()
    {
        parent::__construct();
    }

    function addElement(ReportElement $element)
    {
        $cell = new HTMLTableCell("<b>" . $element->getKey() . "</b>");
        $this->addTableCell($cell);

        $cell = new HTMLTableCell($element->getValue());
        $this->addTableCell($cell);
    }
}
?>