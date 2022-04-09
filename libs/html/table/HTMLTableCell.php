<?php

class HTMLTableCell extends HTMLElementDual
{

    function __construct($str, $rowspan = false, $colspan = false)
    {
        parent::__construct("td");
        $this->content = $str;

        $this->setAttribute("rowspan", $rowspan);
        $this->setAttribute("colspan", $colspan);
    }

    public function buildContent()
    {}
}
?>