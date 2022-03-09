<?php

class BSFormMetaData
{

    private $metaData = array();

    private $submitButtonLabel = "Save";

    private $formActionURL = "";

    private $formData = array();

    private $formFiles = array();

    private $mode = "edit";

    private $isValidFormFields = false;

    private $invalidFormFields = array();

    public function setMode($mode)
    {
        $this->mode = "detail";
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setFormData($data)
    {
        $this->formData = $data;
    }

    public function getFormData()
    {
        return $this->formData;
    }

    public function setFormFiles($files)
    {
        $this->formFiles = $files;
    }

    public function getFormFiles()
    {
        return $this->formFiles;
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

    private function processName($text)
    {
        $text = str_replace("(", "", $text);
        $text = str_replace(")", "", $text);

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        $text = str_replace("-", "_", $text);
        return $text;
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
            "name" => $this->processName($name),
            "label" => $label,
            "type" => $type,
            "gridsize" => $size,
            "options" => $options,
            "mode" => $mode,
            "attrs" => $attrs
        );
        return $field;
    }

    public function createBSFieldRequired($name, $type, $size = 6, $label = false, $options = "", $mode = false, $attrs = array())
    {
        $label = $label ? $label : $name;
        $attrs['required'] = "required";
        $field = array(
            "name" => $this->processName($name),
            "label" => $label,
            "type" => $type,
            "gridsize" => $size,
            "options" => $options,
            "mode" => $mode,
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

    public function createBSFieldCheckbox($name, $options, $size = 6, $label = false, $mode = false, $attrs = array())
    {
        return $this->createBSField($name, "checkbox", $size, $label, $options, $mode, $attrs);
    }

    public function createBSFieldCheckboxRequired($name, $options, $size = 6, $label = false, $attrs = array())
    {
        return $this->createBSFieldRequired($name, "checkbox", $size, $label, $options);
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

    public function validateFormData()
    {
        $this->isValidFormFields = true;

        foreach ($this->metaData as $row) {

            if ($row['type'] == "row") {
                foreach ($row['fields'] as $field) {

                    if (isset($field['attrs']['required'])) {

                        if ($field['type'] == "file") {

                            if (! (isset($this->formFiles[$field['name']]) && $this->formFiles[$field['name']]['error'] == '0')) {
                                $this->invalidFormFields[] = $field['name'];
                                $this->isValidFormFields = false;
                            }
                        } else {

                            if (! (isset($this->formData[$field['name']]) && ! empty($this->formData[$field['name']]))) {
                                $this->invalidFormFields[] = $field['name'];
                                $this->isValidFormFields = false;
                            }
                        }
                    }
                }
            }
        }
    }

    public function isValidFormFields()
    {
        return $this->isValidFormFields;
    }

    public function getInvalidFormFields()
    {
        return $this->invalidFormFields;
    }
}

?>