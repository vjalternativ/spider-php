<?php

class FormField
{

    private $name;

    private $type;

    private $label;

    private $gridsize;

    function __construct($name, $type, $size = 6, $label = false)
    {
        $label = $label ? $label : $name;

        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
        $this->label = $label;
    }
}
?>