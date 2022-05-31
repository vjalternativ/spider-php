<?php
require_once __DIR__ . '/ReportElement.php';

class ReportRow extends HTMLTableRow
{

    function __construct()
    {
        parent::__construct();
    }

    function addElement(ReportElement $element, $addkey = true, $addvalue = true)
    {
        if ($addkey) {
            $cell = new HTMLTableCell("<b>" . $element->getKey() . "</b>");
            $this->addTableCell($cell);
        }
        if ($addvalue) {
            $cell = new HTMLTableCell($element->getValue());
            $this->addTableCell($cell);
        }
    }
}
?>