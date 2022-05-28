<?php

class ViewDetail extends BackendResourceView
{

    public $datatypeFields = array();

    public $tpl = 'include/tpls/detailview.tpl';

    public $data = array();

    public $tableinfo = array();

    public $subpanels = array();

    public $additionalContent = '';

    function __construct()
    {
        $entity = lib_entity::getInstance();
        $datatypes = array();
        $datatypes['varchar'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
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
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
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
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['text'] = array(
            'element' => array(
                'textarea',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
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
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['relate'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['enum'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['dependent_relate'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['nondb'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
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
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
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
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'checkbox',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );
        $datatypes['date'] = array(
            'isdualtag' => false,
            'element' => array(
                'input',
                array(
                    'id' => 'name',
                    'disabled' => 'disabled',
                    'placeholder' => 'name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => '',
                    'class' => 'form-control'
                )
            )
        );

        $this->datatypeFields = $datatypes;

        $vjconfig = lib_config::getInstance()->getConfig();
        $this->tpl = $vjconfig['fwbasepath'] . 'include/tpls/detailview.tpl';

        $entity->load_relationships();

        $this->subpanels = $entity->relationships;
    }

    function display()
    {
        $module = ucfirst($this->module);
        $href = "index.php?module=tableinfo&action=editview";
        $defaultLayout = $this->getDefaultLayout();
        $href = lib_util::processUrl($href);
        $this->params += array(
            'module' => $module,
            'panel' => $defaultLayout
        );

        parent::display();
    }

    function afterDisplay()
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $entity = lib_entity::getInstance();
        $bs = lib_bootstrap::getInstance();
        $smarty = lib_smarty::getSmartyInstance();
        foreach ($this->subpanels as $subpanels) {

            $subpanelModule = ($this->module == $subpanels['rtable']) ? $subpanels['primarytable_name'] : $subpanels['rtable'];

            $pageinfo = $entity->get_relationships($subpanels['name'], false, $subpanels);
            $rows = $pageinfo['data'];

            $rows = array_slice($rows, 0, $pageinfo['resultperpage'], true);

            $headers = array();
            $headers['name']['name'] = "name";
            $headers['name']['label'] = "Name";
            if (isset($subpanels['extracols'])) {
                foreach ($subpanels['extracols'] as $col => $label) {
                    $headers[$col]['name'] = $label;
                }
            }
            $headers['date_entered']['name'] = "date_entered";
            $headers['date_entered']['label'] = "Created";

            $smarty->assign("headers", $headers);
            $smarty->assign("rows", $rows);

            $extraPostFields = array();
            $extraPostFields['id']['data']['html'] = '<button type="button" onclick="removeRelationship(\'' . $entity->record . '\',\'' . $subpanels['name'] . '\',\'REPLACE_KEY\')" class="btn btn-danger">X</button>';
            $extraPostFields['id']['header']['html'] = '';
            $smarty->assign("extraPostFields", $extraPostFields);
            $table = $smarty->fetch($vjconfig['fwbasepath'] . "include/vjlib/libs/tpls/table.tpl");

            $pageinfo['url'] = "./index.php?module=" . $subpanelModule . "&action=getAjaxSubPanelData";

            $pageinfo['container_id'] = $subpanels['id'];

            $pageinfo['record'] = $entity->record;
            $pagingHtml = lib_paginate::getInstance()->getPagingHtml($pageinfo, true);

            $table .= $pagingHtml;

            // $table = $bs->generateTable(array_values($pageinfo['data']),$params);

            $heading = '<span class="heading">' . $subpanelModule . '</span>';
            $heading .= '<input type="hidden" id="subpanel_ptable-' . $subpanels['id'] . '"   value="' . $this->module . '" />';
            $heading .= '<input type="hidden" id="subpanel_rtable-' . $subpanels['id'] . '"   value="' . $subpanelModule . '" />';
            $heading .= '<input type="hidden" id="subpanel_relname-' . $subpanels['id'] . '"   value="' . $subpanels['name'] . '" />';

            $parentModule = "";
            $parentId = "";
            $parentRecord = $_REQUEST['record'];
            if (isset($_REQUEST['parent_module']) && isset($_REQUEST["parent_id"])) {
                $parentModule = $_REQUEST['parent_module'];
                $parentId = $_REQUEST['parent_id'];
            }
            $heading .= '<input type="hidden" id="subpanel_' . $subpanels['id'] . '_parent_module"   value="' . $parentModule . '" />';
            $heading .= '<input type="hidden" id="subpanel_' . $subpanels['id'] . '_parent_id"   value="' . $parentId . '" />';
            $heading .= '<input type="hidden" id="subpanel_' . $subpanels['id'] . '_parent_record"   value="' . $parentRecord . '" />';

            $heading .= '<a href="index.php?module=' . $subpanelModule . '&action=editview&parent_module=' . $this->module . '&parent_record=' . $this->record . '&rel=' . $subpanels['name'] . '"><button class="btn btn-primary pull-right">Add New</button></a>';
            $heading .= '<button class="btn btn-success pull-right margin-right-10" onclick="selectSubpanelItems(\'' . $subpanels['id'] . '\')">Select</button>';
            $heading .= '<div class="clearfix"></div>';

            $panel = $bs->generatePanel($heading, $table, "", "info", "subpanel_" . $subpanels['id']);
            echo $panel;
        }

        $filterhtml = $smarty->fetch($vjconfig['fwbasepath'] . "include/tpls/subpanelfilter.tpl");

        $modal = new lib_modal();
        $modal->id = "subpanel";
        $modal->heading = lib_util::getLabel("LBL_RELATED_RECORDS");
        $modal->afterheader = $filterhtml;
        $modal->extrafooter = '<button type="submit" class="btn btn-primary">Select</button>';
        $modal->formaction = 'index.php?module=' . $_GET['module'] . '&action=addSubpanelRelationship&record=' . $_GET['record'] . '&primaryModule=' . $_GET['module'];
        $smarty->assign("modal", $modal);
        echo $modal->html();
    }

    function getDefaultLayout()
    {
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");

        $entity = lib_entity::getInstance();
        $bs = lib_bootstrap::getInstance();
        $tableinfo = $entity->getwhere("tableinfo", "name ='" . $this->module . "'");
        $vardef = json_decode(base64_decode($tableinfo['description']), 1);

        $languages = $entity->getRelatedData("tableinfo_language_m_m", "tableinfo_id", $tableinfo['id']);

        if ($languages) {
            foreach ($languages as $lang) {
                $suffix = $lang['name'];
                $langTable = $this->module . '_' . $suffix;
                if (isset($globalModuleList[$langTable])) {
                    $vardef = $this->processDefForLang($suffix, $vardef, "detailview");
                }
            }
        }

        if (isset($tableinfo['detailviewdef'])) {

            $ddef = json_decode($tableinfo['detailviewdef'], 1);
            if (is_array($ddef)) {
                $vardef['metadata']['detailview'] = $ddef;
            }
        }

        $globalEntityList = lib_datawrapper::getInstance()->get("entity_list");

        if (isset($globalModuleList[$tableinfo['name']]['relationships'])) {
            foreach ($globalModuleList[$tableinfo['name']]['relationships'] as $rel) {
                if ($rel['rtype'] == "CSTM") {

                    $relTable = $globalEntityList[$rel['secondarytable']];

                    $this->data += $entity->get($relTable['name'], $this->data['id']);
                    $refFields = $globalModuleList[$relTable['name']]['tableinfo']['fields'];

                    $vardef['fields'] += $refFields;

                    $f = array();
                    $f['type'] = 'hr';
                    $f['label'] = $rel['secondarytable_name'];
                    $vardef['metadata']['detailview'][] = $f;

                    $counter = 0;
                    $fields = array(
                        "type" => "row",
                        "fields" => array()
                    );
                    foreach ($refFields as $key => $field) {
                        if ($key == "id") {
                            continue;
                        }
                        $counter ++;
                        $f = array();
                        $f['field'] = $key;
                        $f['gridsize'] = "6";

                        $fields['fields'][] = $f;

                        if ($counter == 2) {

                            $vardef['metadata']['detailview'][] = $fields;
                            $counter = 0;
                            $fields['fields'] = array();
                        }
                    }
                }
            }
        }

        $metadata = $vardef['metadata'];

        $html = $this->parseDetailViewDef('detailview', $vardef);
        $editButton = lib_util::getelement("a", "EDIT", array(
            "href" => "index.php?module=" . $this->module . "&action=editview&record=" . $this->record,
            "class" => "btn btn-primary pull-right"
        ));
        $editButton .= $this->additionalContent;
        $editButton .= lib_util::getelement("div", "", array(
            "class" => "clearfix"
        ));
        $panelheading = $bs->getelement('div', ucfirst($globalModuleList[$this->module]['label']) . ' | Detail View' . $editButton, array(
            'class' => array(
                'value' => 'panel-heading'
            )
        ));
        $panelbody = $bs->getelement('div', $html, array(
            'class' => array(
                'value' => 'panel-body'
            )
        ));
        $panel = $bs->getelement('div', $panelheading . $panelbody, array(
            'class' => array(
                'value' => 'panel panel-info'
            )
        ));
        return $panel;
    }

    function getattr($type, $name, $value = '')
    {
        $attr = $this->datatypeFields[$type];
        if ($type == "relate" || $type == "dependent_relate" || ($type == "nondb" && isset($this->data[$name . '_name']))) {
            $name = $name . "_name";
        }
        // to do make data type associative

        $element = $attr['element'][0];

        $newattr = array();
        $newattr[] = $element;

        $atr = $attr['element'][1];

        if (! isset($this->data[$name])) {
            $this->data[$name] = '';
        }
        foreach ($atr as $key => $at) {

            $atr[$key] = array(
                'value' => str_replace('name', $this->data[$name], $at)
            );
        }

        $newattr[] = $atr;

        if (isset($attr['isdualtag'])) {
            $newattr[] = $attr['isdualtag'];
        }

        return $newattr;
    }

    function parseDetailViewDef($defkey, $vardef)
    {
        $mod_string = lib_datawrapper::getInstance()->get("mod_string_list");

        $def = $vardef['metadata'][$defkey];

        $bs = lib_bootstrap::getInstance();
        $formgroup = '';
        foreach ($def as $item) {

            if (isset($item['type']) && $item['type'] == 'row') {
                if (isset($item['fields'])) {
                    $col = "";
                    foreach ($item['fields'] as $fieldinfo) {
                        $field = $fieldinfo['field'];
                        if (isset($field['name']) && ! isset($field['type'])) {
                            $field = $field['name'];
                        }
                        if (! is_array($field)) {
                            if (isset($vardef['fields'][$field])) {
                                $field = $vardef['fields'][$field];
                            } else {
                                continue;
                            }
                        }
                        $attr = $this->getattr($field['type'], $field['name']);
                        $isdualtag = true;
                        if (isset($attr[2])) {
                            $isdualtag = false;
                        }

                        $label = ucfirst($field['name']);
                        if (isset($field['label'])) {
                            $label = isset($mod_string[$field['label']]) ? $mod_string[$field['label']] : $field['label'];
                        }
                        $addon = lib_util::getelement('span', $label, array(
                            "class" => 'input-group-addon'
                        ));

                        $fhtml = $bs->getelement($attr[0], '', $attr[1], $isdualtag);

                        $fhtml = lib_util::getelement("div", $attr[1]['name']['value'], array(
                            "class" => "form-control"
                        ));
                        if ($field['type'] == "file" && ! empty($this->data[$field['name']])) {
                            $fhtml = '<a target="_blank" class="form-control"  href="index.php?module=media_files&action=download&id=' . $this->data[$field['name']] . '" >Attachment</a>';
                        } else if ($field['type'] == "checkbox") {

                            $checkAttr = array(
                                "type" => "checkbox",
                                "value" => 1,
                                "disabled" => "disabled"
                            );
                            if ($this->data[$field['name']]) {
                                $checkAttr['checked'] = "checked";
                            }
                            $fhtml = lib_util::getelement("input", '', $checkAttr, false);

                            $fhtml = lib_util::getelement("div", $fhtml, array(
                                "class" => "form-control"
                            ));
                        }

                        $elementhtml = $addon . $fhtml;

                        $inputgroup = $bs->getelement("div", $elementhtml, array(
                            "class" => "input-group"
                        ));

                        $colattr = array(
                            "class" => array(
                                "value" => "col-md-" . $fieldinfo['gridsize']
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
            } else {
                if (isset($item['type']) && $item['type'] == "hr") {
                    $formgroup .= $bs->getelement("span", $item['label'], array(
                        "class" => "h4 heading text-primary"
                    ));
                    $formgroup .= $bs->getelement("hr", "", array(
                        "class" => "hr text-primary"
                    ), false);
                }
            }

            // TO DO FOR PANEL
        }

        return $formgroup;
    }
}
?>