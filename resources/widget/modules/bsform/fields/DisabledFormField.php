<?php

class DisabledFormField extends FormField
{

    function __construct($name, $type, $size = 6, $label = false, $options = array(), $attrs = array())
    {
        $label = $label ? $label : $name;

        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
        $this->label = $label;
        $this->mode = "detail";
        $this->attrs = $attrs;
        $this->options = $options;
    }
}
?>