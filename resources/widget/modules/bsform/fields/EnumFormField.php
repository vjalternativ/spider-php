<?php

class EnumFormField extends FormField
{

    private $options;

    function __construct($name, $options, $size, $label)
    {
        $this->options = $options;
        parent::__construct($name, "enum", $size, $label);
    }
}
?>