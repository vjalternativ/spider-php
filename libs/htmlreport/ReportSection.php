<?php

class ReportSection
{

    private $heading;

    private $section;

    function __construct($heading, HTMLElement $section)
    {
        $this->heading = $heading;
        $this->section = $section;
    }

    /**
     *
     * @return mixed
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     *
     * @return HTMLElement
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     *
     * @param mixed $heading
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;
    }

    /**
     *
     * @param HTMLElement $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }
}
?>