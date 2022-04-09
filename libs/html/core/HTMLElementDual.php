<?php
require_once __DIR__ . '/HTMLElement.php';

abstract class HTMLElementDual extends HTMLElement
{

    protected $content = "";

    abstract function buildContent();

    protected function appendContent($str)
    {
        $this->content .= $str;
    }

    public function getHTML()
    {
        $html = "";
        if ($this->tag) {
            $html = "<" . $this->tag . ' ';

            foreach ($this->attributes as $key => $val) {
                $html .= ' ' . $key . '="' . $val . '" ';
            }
            $html .= ">" . "\n";
        }
        $this->buildContent();

        $html .= $this->content;

        if ($this->tag) {
            $html .= "</" . $this->tag . '>';
        }
        return $html . "\n";
    }

    protected function asHTMLElementDual(HTMLElementDual $ob)
    {
        return $ob;
    }
}
?>