<?php

class HTMLSpan extends HTMLElementDual
{

    function __construct($str = "")
    {
        parent::__construct("span");
        $this->content = $str;
    }

    public function buildContent()
    {}
}
?>