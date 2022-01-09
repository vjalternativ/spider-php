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

    public function createBSField($name, $type, $size = 6, $label = false, $options = "", $mode = false, $attrs = array())
    {
        $label = $label ? $label : $name;
        $field = array(
            "name" => $name,
            "label" => $label,
            "type" => $type,
            "gridsize" => $size,
            "options" => $options,
            "mode" => $mode,
            "attrs" => $attrs
        );
        return $field;
    }

    public function createBSFieldRequired($name, $type, $size = 6, $label = false, $options = "", $attrs = array())
    {
        $label = $label ? $label : $name;
        $attrs['required'] = "required";
        $field = array(
            "name" => $name,
            "label" => $label,
            "type" => $type,
            "gridsize" => $size,
            "options" => $options,
            "mode" => false,
            "attrs" => $attrs
        );

        return $field;
    }

    public function createBSFieldEnum($name, $options, $size = 6, $label = false, $mode = false, $attrs = array())
    {
        return $this->createBSField($name, "enum", $size, $label, $options, $mode, $attrs);
    }

    public function createBSFieldEnumRequired($name, $options, $size = 6, $label = false, $attrs = array())
    {
        return $this->createBSFieldRequired($name, "enum", $label);
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