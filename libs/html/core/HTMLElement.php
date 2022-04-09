<?php

class HTMLElement
{

    protected $attributes = array();

    protected $tag;

    function __construct($tag)
    {
        $this->tag = $tag;
    }

    protected function setAttribute($key, $val)
    {
        if ($val !== null) {
            $this->attributes[$key] = $val;
        }
    }

    public function getHTML()
    {
        $html = "<" . $this->tag . ' ';

        foreach ($this->attributes as $key => $val) {
            $html .= ' ' . $key . '="' . $val . '" ';
        }

        $html .= " />";

        return $html . "\n";
    }

    public function setStyles($arr = array())
    {
        foreach ($arr as $key => $val) {
            $this->styles[$key] = $val;
        }
    }

    protected function asHTMLElement(HTMLElement $ob)
    {
        return $ob;
    }
}

?>