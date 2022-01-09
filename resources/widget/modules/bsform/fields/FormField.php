<?php

class FormField
{

    private $name;

    private $type;

    private $label;

    private $gridsize;

    private $mode = false;

    private $options = array();

    function __construct($name, $type, $size = 6, $label = false, $options = array(), $mode = false, $attrs = array())
    {
        $label = $label ? $label : $name;

        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
        $this->label = $label;
        $this->mode = $mode;
        $this->attrs = $attrs;
        $this->options = $options;
    }
}
?>