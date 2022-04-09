<?php
require_once __DIR__ . '/ReportTable.php';
require_once __DIR__ . '/ReportSection.php';

class HTMLReport extends HTMLElementDual
{

    private $sections = array();

    function __construct()
    {}

    private function asReportSection(ReportSection $ob)
    {
        return $ob;
    }

    public function buildContent()
    {
        foreach ($this->sections as $ob) {
            $ob = $this->asReportSection($ob);
            $h4 = new HTMLH4($ob->getHeading());
            $this->appendContent($h4->getHTML());
            $this->appendContent($ob->getSection()
                ->getHTML());
        }
    }

    public function addHTMLSection($heading, HTMLElement $ob)
    {
        $this->sections[] = new ReportSection($heading, $ob);
    }
}
?>