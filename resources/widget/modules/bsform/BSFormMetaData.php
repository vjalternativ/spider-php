<?php

class BSFormMetaData
{

    private $metaData = array();

    private $submitButtonLabel = "Save";

    private $formActionURL = "";

    private $data = array();

    private $mode = "edit";

    public function setMode($mode)
    {
        $this->mode = "detail";
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setFormActiionURL($url)
    {
        $this->formActionURL = $url;
    }

    public function setSubmitButtonLabel($label)
    {
        $this->submitButtonLabel = $label;
    }

    public function getFormActionURL()
    {
        return $this->formActionURL;
    }

    public function getSubmitButtonLabel()
    {
        return $this->submitButtonLabel;
    }

    public function addBSFormRow($fields = array())
    {
        if ($fields) {
            $row = array();
            $row['type'] = "row";
            $row['fields'] = $fields;
            $this->metaData[] = $row;
        }
    }

    public function createBSField($name, $type, $size = 6, $label = false, $options = array(), $mode = false)
    {
        $label = $label ? $label : $name;
        $field = array(
            "name" => $name,
            "label" => $label,
            "type" => $type,
            "gridsize" => $size,
            "options" => $options,
            "mode" => $mode
        );
        return $field;
    }

    public function getMetaDef()
    {
        return $this->metaData;
    }

    public function addHR($label)
    {
        $row = array();
        $row['type'] = "hr";
        $row['label'] = $label;
        $this->metaData[] = $row;
    }

    public function addHTML($html)
    {
        $row = array();
        $row['type'] = "custom_html";
        $row['html'] = $html;
        $this->metaData[] = $row;
    }
}

?>