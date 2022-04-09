<?php

class HTMLH4 extends HTMLElementDual
{

    function __construct($content)
    {
        parent::__construct("h4");
        $this->content = $content;
    }

    public function buildContent()
    {}
}
?>