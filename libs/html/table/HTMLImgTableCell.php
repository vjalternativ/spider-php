<?php
require_once __DIR__ . '/../core/HTMLImg.php';

class HTMLImgTableCell extends HTMLTableCell
{

    function __construct(HTMLImg $img, $rowspan = false, $colspan = false)
    {
        parent::__construct($img->getHTML(), $rowspan, $colspan);
    }
}
?>