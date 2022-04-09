<?php
require_once __DIR__ . '/HTMLElement.php';

class HTMLImg extends HTMLElement
{

    function __construct($src, $width = null, $height = null)
    {
        parent::__construct("img");
        $this->setAttribute("src", $src);
        $this->setAttribute("width", $width);
        $this->setAttribute("height", $height);
    }
}
?>