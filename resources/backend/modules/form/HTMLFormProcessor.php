<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'libs/lib_bootstrap.php';

class HTMLFormProcessor
{

    private $fields = array();

    private $datatypeFields = array();

    private $tpl = "";

    private $mode = 'edit';

    private $metaData = array();

    private $submitButtonLabel = "Save";

    private $formActionURL = "";

    private $formData = array();

    private $formFiles = array();

    private $isValidFormFields = false;

    private $invalidFormFields = array();

    private $title;

    private $forModule = "";

    function __construct()
    {
        $datatypes = array();
        $datatypes['varchar'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['int'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['float'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['text'] = array(
            'element' => array(
                'textarea',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['relate'] = array(
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['enum'] = array(
            'element' => array(
                'select',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['dependent_relate'] = array(
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['nondb'] = array(
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['file'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'file',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['checkbox'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'checkbox',
                    'value' => 'name',
                    'class' => ''
                )
            )
        );
        $datatypes['date'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'date',
                    'value' => 'name',
                    'class' => 'form-control'
                )
            )
        );

        $datatypes['datepicker'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => 'name',
                    'class' => 'form-control  datepicker'
                )
            )
        );

        $datatypes['md5'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => 'name',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['datetime'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => 'name',
                    'class' => 'form-control  datetimepicker'
                )
            )
        );
        $datatypes['editor'] = array(
            'element' => array(
                'textarea',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control editor'
                )
            )
        );

        $datatypes['password'] = array(
            'element' => array(
                'password',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control'
                )
            )
        );

        $datatypes['multienum'] = array(
            'element' => array(
                'select',
                array(
                    'id' => 'name',
                    'name' => 'name',
                    'class' => 'form-control multienum',
                    "multiple" => "multiple"
                )
            )
        );

        $this->datatypeFields = $datatypes;
        $this->tpl = lib_config::getInstance()->get('fwbasepath') . 'include/tpls/editview.tpl';
    }

    private function processModuleDef()
    {
        foreach ($this->metaData as $metakey => $item) {

            $item['type'] = isset($item['type']) ? $item['type'] : 'row';

            if (isset($item['type']) && $item['type'] == 'row') {

                if (isset($item['fields'])) {

                    if (isset($item['fields']['field'])) {

                        $field = $item['fields']['field'];
                        $item['fields'] = array();

                        $item['fields'][] = $field;
                    }

                    foreach ($item['fields'] as $fkey => $fieldarray) {

                        // $gridsize = $fieldarray['gridsize'] ? $fieldarray['gridsize'] : 6;
                        $isreq = isset($fieldarray['r']) ? true : false;
                        if ($isreq) {

                            $this->metaData[$metakey]['fields'][$fkey]['attrs']['required'] = 'required';
                        }
                    }
                }
            }
        }
    }

    function loadModuleDef($moduleName)
    {
        $module = lib_datawrapper::getInstance()->get("module_list", $moduleName);
        $this->setForModule($module);
        if ($module && isset($module['tableinfo'])) {
            $this->fields = $module['tableinfo']['fields'];
            $this->metaData = json_decode($module['editviewdef'], true);
            $this->processModuleDef();
        }
    }

    /**
     *
     * @return string
     */
    public function getForModule()
    {
        return $this->forModule;
    }

    /**
     *
     * @param string $forModule
     */
    public function setForModule($forModule)
    {
        $this->forModule = $forModule;
    }

    function parseEditViewDef()
    {
        $def = $this->metaData;

        $data = $this->formData;
        $files = $this->formFiles;

        $mod_string = lib_datawrapper::getInstance()->get("mod_string_list");
        $entity = lib_entity::getInstance();

        $mode = $this->getMode();
        $bs = lib_bootstrap::getInstance();
        $formgroup = '';

        foreach ($def as $item) {
            $item['type'] = isset($item['type']) ? $item['type'] : 'row';

            if (isset($item['type']) && $item['type'] == 'row') {

                if (isset($item['fields'])) {
                    $col = "";

                    if (isset($item['fields']['field'])) {

                        $field = $item['fields']['field'];
                        $item['fields'] = array();

                        $item['fields'][] = $field;
                    }

                    foreach ($item['fields'] as $fieldarray) {

                        $gridsize = (isset($fieldarray['gridsize']) && $fieldarray['gridsize']) ? $fieldarray['gridsize'] : 6;
                        $isreq = isset($fieldarray['r']) ? true : false;
                        $fieldkey = is_array($fieldarray) ? $fieldarray['field'] : $fieldarray;

                        $fieldkey = is_array($fieldkey) ? $fieldkey['name'] : $fieldkey;

                        $fieldarray = $this->fields[$fieldkey];

                        $fieldarray['gridsize'] = $gridsize;

                        if ($isreq) {
                            $fieldarray['attrs']['required'] = 'required';
                        }
                        $fieldname = $fieldarray['name'];

                        $val = "";

                        $attr = $this->getattr($fieldarray['type'], $fieldname, $val);

                        if (isset($fieldarray['extraclass'])) {
                            $attr[1]['class'] .= $fieldarray['extraclass'];
                        }

                        if (isset($fieldarray['attrs']) && $fieldarray['attrs']) {
                            foreach ($fieldarray['attrs'] as $key => $val) {
                                $attr[1][$key] = $val;
                            }
                        }
                        $isdualtag = true;

                        if (! isset($data[$fieldname])) {
                            $data[$fieldname] = "";
                        }

                        if (isset($attr[1]['value'])) {
                            $attr[1]['value'] = htmlentities($attr[1]['value']);
                        }

                        $val = isset($data[$fieldarray['name']]) ? $data[$fieldarray['name']] : "";

                        if (isset($attr[2])) {
                            $isdualtag = false;
                        }

                        switch ($fieldarray['type']) {
                            case "checkbox":
                                $attr[1]['value'] = 1;
                                break;
                            case "md5":
                                $attr[1]['value'] = "";
                                break;
                            case "varchar":
                            case "password":
                            case "date":
                            case "datepicker":
                                $attr[1]['value'] = $val;
                                break;
                        }

                        if (isset($fieldarray['mode']) && $fieldarray['mode']) {
                            if ($fieldarray['mode'] == "detail") {
                                $attr[1]['disabled'] = "disabled";
                            }
                        } else {
                            if ($mode == "detail") {
                                $attr[1]['disabled'] = "disabled";
                            }
                        }

                        $field = lib_util::getelement($attr[0], $val, $attr[1], $isdualtag);

                        $label = ucfirst($fieldarray['name']);

                        if (isset($fieldarray['label'])) {

                            $label = isset($mod_string[$fieldarray['label']]) ? $mod_string[$fieldarray['label']] : $fieldarray['label'];
                        }

                        if ($fieldarray['type'] == 'relate') {
                            if (! isset($data[$fieldarray['name'] . "_name"])) {
                                $data[$fieldarray['name'] . "_name"] = "";
                            }
                            $field = $bs->getelement('input', '', array(
                                "class" => "form-control",
                                "id" => $fieldarray['name'] . '_name',
                                "value" => $data[$fieldarray['name'] . "_name"],
                                "name" => $fieldarray['name'] . '_name',
                                "autocomplete" => "off",
                                "onkeyup" => "relatemodule('" . $fieldarray['rmodule'] . "',this.value,'" . $fieldarray['name'] . "')"
                            ), false);
                            $field .= $bs->getelement('input', '', array(
                                "class" => "form-control",
                                "name" => $fieldarray['name'],
                                "id" => $fieldarray['name'],
                                "type" => "hidden",
                                "value" => $data[$fieldarray['name']]
                            ), false);
                        } else if ($fieldarray['type'] == 'dependent_relate') {
                            if (! isset($data[$fieldarray['name'] . "_name"])) {
                                $data[$fieldarray['name'] . "_name"] = "";
                            }
                            $field = $bs->getelement('input', '', array(
                                "class" => "form-control",
                                "value" => $data[$fieldarray['name'] . "_name"],
                                "id" => $fieldarray['name'] . '_name',
                                "name" => $fieldarray['name'] . '_name',
                                "autocomplete" => "off",
                                "onkeyup" => "dependentRelatemodule('" . $fieldarray['relate_relationship'] . "','" . $fieldarray['dependent_relate_field'] . "','" . $fieldarray['rmodule'] . "',this.value,'" . $fieldarray['name'] . "')"
                            ), false);
                            $field .= $bs->getelement('input', '', array(
                                "class" => "form-control",
                                "name" => $fieldarray['name'],
                                "id" => $fieldarray['name'],
                                "type" => "hidden",
                                "value" => $data[$fieldarray['name']]
                            ), false);
                        } else if ($fieldarray['type'] == 'nondb' && isset($fieldarray['rmodule'])) {

                            if (! isset($data[$fieldarray['name'] . "_name"])) {
                                $data[$fieldarray['name'] . '_name'] = "";
                            }
                            if ($fieldarray['type'] == "nondb" && isset($_REQUEST['parent_module']) && $_REQUEST['parent_module'] == $fieldarray['rmodule']) {
                                $data[$fieldarray['name']] = $_REQUEST['parent_record'];
                                $pmodule = $_REQUEST['parent_module'];
                                $nondbData = $entity->get($pmodule, $data[$fieldarray['name']]);
                                if ($nondbData) {
                                    $data[$fieldarray['name']] = $nondbData['id'];
                                    $data[$fieldarray['name'] . '_name'] = $nondbData['name'];
                                }
                            }

                            $field = $bs->getelement('input', '', array(
                                "class" => "form-control",
                                "id" => $fieldarray['name'] . '_name',
                                "value" => $data[$fieldarray['name'] . '_name'],
                                "name" => $fieldarray['name'] . '_name',
                                "autocomplete" => "off",
                                "onkeyup" => "relatemodule('" . $fieldarray['rmodule'] . "',this.value,'" . $fieldarray['name'] . "')"
                            ), false);
                            $field .= $bs->getelement('input', '', array(
                                "class" => "form-control",
                                "name" => $fieldarray['name'],
                                "id" => $fieldarray['name'],
                                "type" => "hidden",
                                "value" => $data[$fieldarray['name']]
                            ), false);
                        } else if ($fieldarray['type'] == 'enum' || $fieldarray['type'] == 'multienum') {

                            $field = $this->getEnumOptionsHTML($fieldarray, $val, $attr[1]);

                            /*
                             * if (! isset($fieldarray['options']) || ! isset($app_list_strings[$fieldarray['options']])) {
                             * $fieldarray['options'] = false;
                             * // die("option is not defined for field".$fieldarray['name']);
                             * }
                             *
                             * $optionhtml = "";
                             * if (isset($app_list_strings[$fieldarray['options']])) {
                             * $options = $app_list_strings[$fieldarray['options']];
                             * foreach ($options as $okey => $oval) {
                             * $opattr = array(
                             * "value" => $okey
                             * );
                             * if ($val == $okey) {
                             * $opattr['selected'] = "selected";
                             * }
                             * $optionhtml .= lib_util::getelement('option', $oval, $opattr);
                             * }
                             * }
                             * $field = lib_util::getelement($attr[0], $optionhtml, $attr[1], $isdualtag);
                             */
                        } else if ($fieldarray['type'] == "checkbox") {

                            if ($val == '1') {
                                $attr[1]['checked'] = "checked";
                                $field = lib_util::getelement($attr[0], "", $attr[1], $isdualtag);
                            }
                            $field = lib_util::getelement("div", $field, array(
                                "class" => "form-control checkbox-form-control"
                            ));

                            if (isset($fieldarray['options']) && is_array($fieldarray['options']) && $fieldarray['options']) {

                                $field = "";
                                foreach ($fieldarray['options'] as $option) {

                                    $field .= lib_util::getelement("input", "", array(
                                        "type" => "checkbox",
                                        "name" => $fieldarray['name'] . "[]",
                                        "value" => $option
                                    ), false) . " " . $option . " ";
                                }

                                $field = lib_util::getelement("div", $field, array(
                                    "class" => "form-control checkbox-form-control"
                                ));
                            }
                        }

                        $elementhtml = "";

                        $addon = "";

                        $addon = lib_util::getelement('span', $label, array(
                            "class" => 'input-group-addon pre-addon'
                        ));
                        $elementhtml = $addon . $field;

                        if ($fieldarray['type'] == 'relate' || $fieldarray['type'] == 'dependent_relate' || ($fieldarray['type'] == "nondb" && isset($fieldarray['rmodule']))) {
                            $addon = $bs->getelement('span', '<i class="fa fa-search"></i>', array(
                                "class" => 'input-group-addon'
                            ));
                            $elementhtml .= $addon;

                            // $elementhtml .= $bs->getelement('button','Select',array("class"=>'btn btn-primary'));
                        }
                        $inputgroup = $bs->getelement("div", $elementhtml, array(
                            "class" => "input-group"
                        ));
                        if ($fieldarray['type'] == "file") {
                            if ($files) {

                                if (isset($files[$fieldarray['name']]) && $files[$fieldarray['name']]['error'] == "0") {

                                    $inputgroup .= "<br />";

                                    $link = MediaFilesService::getInstance()->getMediaLinkForPath($files[$fieldarray['name']]['tmp_name'], $files[$fieldarray['name']]['name'], $files[$fieldarray['name']]['type']);
                                    $inputgroup .= '<a target="_blank"  href="' . $link . '" >' . $files[$fieldarray['name']]['name'] . '</a>';
                                    // $inputgroup .= '&nbsp;&nbsp;<a href="#" onclick="removeAttachment(\'' . $this->module . '\',\'' . $this->record . '\',\'' . $fieldarray['name'] . '\',\'' . $data[$fieldarray['name']] . '\')" >Remove</a>';
                                }
                            } else {
                                // $inputgroup .= "<br />";
                                // $inputgroup .= '<a target="_blank" href="index.php?module=media_files&action=download&id=' . $data[$fieldarray['name']] . '" >Attachment</a>';
                                // $inputgroup .= '&nbsp;&nbsp;<a href="#" onclick="removeAttachment(\'' . $this->module . '\',\'' . $this->record . '\',\'' . $fieldarray['name'] . '\',\'' . $data[$fieldarray['name']] . '\')" >Remove</a>';
                            }
                        }

                        $fieldarray['gridsize'] = isset($fieldarray['gridsize']) ? $fieldarray['gridsize'] : "6";
                        $colattr = array(
                            "class" => array(
                                "value" => "col-md-" . $fieldarray['gridsize']
                            )
                        );
                        $col .= $bs->getelement('div', $inputgroup, $colattr);
                    }
                }

                $row = $bs->getelement("div", $col, array(
                    'class' => array(
                        'value' => 'row'
                    )
                ));

                $formgroup .= $bs->getelement("div", $row, array(
                    'class' => array(
                        'value' => 'form-group'
                    )
                ));
            } else if (isset($item['type']) && $item['type'] == "hr") {
                $formgroup .= $bs->getelement("div", $item['label'], array(
                    "class" => "hr_additional"
                ));
                $formgroup .= $bs->getelement("hr", false, false, false);
            } else if (isset($item['type']) && $item['type'] == "custom_html") {
                $content = $bs->getelement("div", $item['html'], array(
                    "class" => "col-md-12"
                ));
                $formgroup .= $bs->getelement("div", $content, array(
                    "class" => "row"
                ));
            }

            // TO DO FOR PANEL
        }

        return $formgroup;
    }

    function getDefaultLayout($params)
    {}

    function getattr($type, $name, $value = '')
    {
        $data = $this->getFormData();
        $attr = $this->datatypeFields[$type];
        // to do make data type associative
        $element = $attr['element'][0];
        $newattr = array();
        $newattr[] = $element;
        $atr = $attr['element'][1];
        foreach ($atr as $key => $at) {
            if ($key == 'value') {
                $atr[$key] = "";

                if (isset($data[$name])) {
                    $atr[$key] = $data[$name];
                }
            } else if ($at == 'name') {

                $atr[$key] = $name;
            }
        }

        if ($type == "multienum") {

            $atr['name'] = $name . '[]';
        }

        $newattr[] = $atr;
        if (isset($attr['isdualtag'])) {
            $newattr[] = $attr['isdualtag'];
        }
        return $newattr;
    }

    function getFormHTML()
    {
        $bs = lib_bootstrap::getInstance();

        $data = $this->getFormData();

        $data['id'] = isset($data['id']) ? $data['id'] : "";

        $html = $this->parseEditViewDef();

        $html .= $bs->getelement('input', '', array(
            'name' => 'id',
            'id' => 'id',
            'value' => $data['id'],
            'type' => 'hidden'
        ));
        $save = $bs->getelement("button", $this->getSubmitButtonLabel(), array(
            "type" => array(
                "value" => "submit"
            ),
            "class" => array(
                "value" => "btn btn-primary pull-right"
            ),
            "id" => array(
                "value" => "submit-form"
            )
        ));
        $save .= '<div class="clearfix"></div>';

        $panelheading = "";

        if ($this->title) {
            $panelheading = $bs->getelement('div', ucfirst($this->title), array(
                'class' => array(
                    'value' => 'panel-heading'
                )
            ));
        }

        $panelbody = $bs->getelement('div', $html, array(
            'class' => array(
                'value' => 'panel-body'
            )
        ));
        $panelfooter = $bs->getelement('div', $save, array(
            'class' => array(
                'value' => 'panel-footer'
            )
        ));
        $panel = $bs->getelement('div', $panelheading . $panelbody . $panelfooter, array(
            'class' => array(
                'value' => 'panel panel-info'
            )
        ));

        $url = $this->getFormActionURL();
        $form = $bs->getelement('form', $panel, array(
            "name" => array(
                "value" => "editview"
            ),
            "method" => array(
                "value" => "post"
            ),
            "action" => array(
                "value" => $url
            ),
            "enctype" => array(
                "value" => "multipart/form-data"
            ),
            "id" => array(
                "value" => "editview_form"
            )
        ));
        return $form;
    }

    private function getMode()
    {
        return $this->mode;
    }

    public function getFormData()
    {
        return $this->formData;
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
        $this->fields[$field['name']] = $field;
        return $field['name'];
    }

    public function createBSFieldRequired($name, $type, $size = 6, $label = false, $options = "", $mode = false, $attrs = array())
    {
        $attrs['required'] = "required";

        return $this->createBSField($name, $type, $size, $label, $options, $mode, $attrs);
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

                    if (isset($this->fields[$field['field']['name']]) && isset($field['attrs']['required'])) {
                        $field['type'] = $this->fields[$field['field']['name']]['type'];
                        if ($field['type'] == "file") {

                            if (! (isset($this->formFiles[$field['name']]) && $this->formFiles[$field['name']]['error'] == '0')) {
                                $this->invalidFormFields[] = $field['name'];
                                $this->isValidFormFields = false;
                            }
                        } else {

                            if (! (isset($this->formData[$field['field']['name']]) && ! empty($this->formData[$field['field']['name']]))) {
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

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function setFormData($data)
    {
        $this->formData = $data;
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

    function loadformDef($formalias)
    {
        $data = lib_entity::getInstance()->getwhere("form", 'alias="' . $formalias . '"');

        if ($data) {

            $moduleName = $data['module'];
            $this->setForModule($moduleName);
            $module = lib_datawrapper::getInstance()->get("module_list", $moduleName);

            $this->fields = $module['tableinfo']['fields'];

            $datafields = json_decode(base64_decode($data['description']), true);

            if (isset($datafields['fields'])) {

                foreach ($datafields['fields'] as $key => $field) {
                    if (isset($this->fields[$key])) {
                        continue;
                    }

                    $field['virtualfield'] = true;
                    $this->fields[$key] = $field;
                }
            }

            $this->metaData = json_decode($data['editviewdef'], true);

            $this->processModuleDef();
        }
    }

    private function getEnumOptionsHTML($fieldarray, $value, $attrs)
    {
        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");

        if (! isset($fieldarray['options']) || ! isset($app_list_strings[$fieldarray['options']])) {
            $fieldarray['options'] = false;
            // die("option is not defined for field".$fieldarray['name']);
        }

        $optionhtml = "";

        if ($fieldarray['options']) {
            if (isset($app_list_strings[$fieldarray['options']])) {
                $options = $app_list_strings[$fieldarray['options']];
                foreach ($options as $okey => $oval) {
                    $opattr = array(
                        "value" => $okey
                    );
                    if ($value == $okey) {
                        $opattr['selected'] = "selected";
                    }
                    $optionhtml .= lib_util::getelement('option', $oval, $opattr);
                }
            }
        }

        if (isset($fieldarray['relationship'])) {

            $relationship = lib_datawrapper::getInstance()->get("relationship_list", $fieldarray['relationship']);

            $secondary = lib_datawrapper::getInstance()->get("entity_list", $relationship['secondarytable']);

            $module = $secondary['name'];

            $sql = "select * from " . $module . " where deleted=0 order by name asc limit 10";
            $rows = lib_database::getInstance()->getAll($sql);
            foreach ($rows as $row) {
                $opattr = array(
                    "value" => $row['id']
                );

                $optionhtml .= lib_util::getelement('option', $row['name'], $opattr);
            }

            $attrs['data-ajax'] = lib_config::getInstance()->get("baseurl") . "index.php?resource=backend&module=tableinfo&action=ajaxGetRelatedData&formodule=" . $module;
        }
        return lib_util::getelement("select", $optionhtml, $attrs, true);
    }

    public function getFields()
    {
        return $this->fields;
    }
}

?>