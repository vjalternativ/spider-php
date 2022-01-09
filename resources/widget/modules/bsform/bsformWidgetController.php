<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'libs/lib_bootstrap.php';

class bsformWidgetController extends WidgetResourceController
{

    private $datatypeFields = array();

    private $tpl = "";

    function __construct()
    {
        parent::__construct();
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

        $this->datatypeFields = $datatypes;
        $vjconfig = lib_config::getInstance()->getConfig();
        $this->tpl = $vjconfig['fwbasepath'] . 'include/tpls/editview.tpl';
    }

    function processWidgetParams($params)
    {
        $params['layout'] = $this->getDefaultLayout($params);

        return $params;
    }

    private function asBSFormMeta(BSFormMetaData $ob)
    {
        return $ob;
    }

    function getDefaultLayout($params)
    {
        $metadata = $params['metadata'];
        $metadata = $this->asBSFormMeta($metadata);

        $bs = lib_bootstrap::getInstance();

        $data = $metadata->getData();

        $data['id'] = isset($data['id']) ? $data['id'] : "";

        $html = $this->parseEditViewDef($metadata);

        $html .= $bs->getelement('input', '', array(
            'name' => 'id',
            'id' => 'id',
            'value' => $data['id'],
            'type' => 'hidden'
        ));
        $save = $bs->getelement("button", $metadata->getSubmitButtonLabel(), array(
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

        if (isset($params['title'])) {
            $panelheading = $bs->getelement('div', ucfirst($params['title']), array(
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

        $url = $metadata->getFormActionURL();
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

    function getattr($type, $name, $value = '', BSFormMetaData $meta)
    {
        $data = $meta->getData();
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
        $newattr[] = $atr;
        if (isset($attr['isdualtag'])) {
            $newattr[] = $attr['isdualtag'];
        }
        return $newattr;
    }

    function parseEditViewDef(BSFormMetaData $metaData)
    {
        $def = $metaData->getMetaDef();

        $data = $metaData->getData();

        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");
        $mod_string = lib_datawrapper::getInstance()->get("mod_string_list");
        $entity = lib_entity::getInstance();

        $mode = $metaData->getMode();
        $bs = lib_bootstrap::getInstance();
        $formgroup = '';
        foreach ($def as $item) {
            if (isset($item['type']) && $item['type'] == 'row') {
                if (isset($item['fields'])) {
                    $col = "";
                    foreach ($item['fields'] as $fieldname => $fieldarray) {

                        $fieldarray['name'] = $fieldname;

                        $val = "";

                        if (! isset($fieldarray['type'])) {
                            echo "<pre>";
                            print_r($fieldarray);
                            die();
                        }
                        $attr = $this->getattr($fieldarray['type'], $fieldname, $val, $metaData);
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

                        $val = $data[$fieldarray['name']];

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

                        if ($fieldarray['mode']) {
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
                        } else if ($fieldarray['type'] == 'enum') {

                            if (! isset($fieldarray['options']) || ! isset($app_list_strings[$fieldarray['options']])) {
                                $fieldarray['options'] = false;
                                // die("option is not defined for field".$fieldarray['name']);
                            }

                            $optionhtml = "";
                            if (isset($app_list_strings[$fieldarray['options']])) {
                                $options = $app_list_strings[$fieldarray['options']];
                                foreach ($options as $okey => $oval) {
                                    $opattr = array(
                                        "value" => $okey
                                    );
                                    if ($val == $okey) {
                                        $opattr['selected'] = "selected";
                                    }
                                    $optionhtml .= lib_util::getelement('option', $oval, $opattr);
                                }
                            }
                            $field = lib_util::getelement($attr[0], $optionhtml, $attr[1], $isdualtag);
                        } else if ($fieldarray['type'] == "checkbox") {

                            if ($val == '1') {
                                $attr[1]['checked'] = "checked";
                                $field = lib_util::getelement($attr[0], "", $attr[1], $isdualtag);
                            }
                            $field = lib_util::getelement("div", $field, array(
                                "class" => "form-control checkbox-form-control"
                            ));
                        }

                        $elementhtml = "";

                        $addon = "";

                        if ($fieldarray['type'] == "checkbox") {

                            $addon = lib_util::getelement('span', $label, array(
                                "class" => 'input-group-addon post-addon'
                            ));
                            $elementhtml = $field . $addon;
                        } else {
                            $addon = lib_util::getelement('span', $label, array(
                                "class" => 'input-group-addon pre-addon'
                            ));
                            $elementhtml = $addon . $field;
                        }

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

                        if ($fieldarray['type'] == "file" && ! empty($data[$fieldarray['name']])) {
                            $inputgroup .= "<br />";
                            $inputgroup .= '<a target="_blank"  href="index.php?module=media_files&action=download&id=' . $data[$fieldarray['name']] . '" >Attachment</a>';
                            $inputgroup .= '&nbsp;&nbsp;<a href="#" onclick="removeAttachment(\'' . $this->module . '\',\'' . $this->record . '\',\'' . $fieldarray['name'] . '\',\'' . $data[$fieldarray['name']] . '\')" >Remove</a>';
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
}
?>