<?php

class widgetViewEdit extends ViewEdit
{

    function preDisplay()
    {
        parent::preDisplay();

        $db = lib_database::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $app_list_strings = lib_datawrapper::getInstance()->get("app_list_strings_list");

        $app_list_strings['widget_type_list'] = array();

        $folders = scandir($vjconfig['basepath'] . 'resources/widget/modules/');

        unset($folders[0]);
        unset($folders[1]);
        $folders = array_combine($folders, $folders);

        $sitefolder = scandir($vjconfig['fwbasepath'] . 'resources/widget/modules/');

        unset($sitefolder[0]);
        unset($sitefolder[1]);

        $sitefolder = array_combine($sitefolder, $sitefolder);

        $folders = array_merge($folders, $sitefolder);

        $folders[''] = "select";

        $app_list_strings['widget_type_list'] = $folders;

        lib_datawrapper::getInstance()->set("app_list_strings_list", $app_list_strings);

        $posList = array();
        $posList[''] = "select";

        $this->def['fields']['widget_type']['options'] = 'widget_type_list';
        $pageId = false;
        if (isset($_REQUEST['parent_record'])) {
            $pageId = $_REQUEST['parent_record'];
        } else if ($this->data) {
            $widgetId = $this->data['id'];

            $sql = "select page_id from page_widget_m_m where deleted=0 and widget_id='" . $widgetId . "'";
            $pageData = $db->getrow($sql);

            if ($pageData) {
                $pageId = $pageData['page_id'];
            }
        }

        $vjconfig = lib_config::getInstance()->getConfig();
        if (file_exists($vjconfig['basepath'] . "include/entrypoints/site/layout/" . $vjconfig['sitetpl'] . "/" . $vjconfig['sitetpl'] . "Positions.php")) {
            require_once $vjconfig['basepath'] . "include/entrypoints/site/layout/" . $vjconfig['sitetpl'] . "/" . $vjconfig['sitetpl'] . "Positions.php";
        }

        if ($pageId) {
            $entity = lib_entity::getInstance();
            $pageData = $entity->get("page", $pageId);
            $page = $pageData['name'];
            if (file_exists($vjconfig['basepath'] . "include/entrypoints/site/pages/" . $page . "/layout/" . $vjconfig['sitetpl'] . "/" . $page . "Positions.php")) {
                require_once $vjconfig['basepath'] . "include/entrypoints/site/pages/" . $page . "/layout/" . $vjconfig['sitetpl'] . "/" . $page . "Positions.php";
            }
        }
        $posList = array(); //todo : pos list support
        $posList[''] = "select";

        $GLOBALS['app_list_strings']['position_list'] = $posList;

        $this->def['fields']['position']['options'] = 'position_list';

        $this->processDefForRegisteredFields();
    }

    function processDefForRegisteredFields()
    {
        unset($this->def['fields']['description']);
        unset($this->def['metadata']['editview'][1]);

        if (isset($this->data['description'])) {
            $json = json_decode($this->data['description'], 1);
            foreach ($json as $key => $val) {
                $this->data[$key] = $val;
            }
            $wtype = $this->data['widget_type'];

            $fields = WidgetServiceRegistrar::getWidgetServiceInstance()->getWidgetConfigFields($wtype);
            if($fields) {
                foreach ($fields as $field) {
                    $this->def['fields'][$field['name']]['name'] = $field['name'];
                    $this->def['fields'][$field['name']]['type'] = $field['type'];
                    $this->def['metadata']['editview'][$field['name']]['type'] = 'row';
                    $this->def['metadata']['editview'][$field['name']]['fields'][0]['gridsize'] = 6;
                    $this->def['metadata']['editview'][$field['name']]['fields'][0]['field'] = $field;
                }
            }

        }
    }

    function display()
    {
        parent::display();
        $vjconfig = lib_config::getInstance()->getConfig();
        echo '<script src="'.$vjconfig['fwbaseurl'].'resources/backend/assets/ckeditor/ckeditor.js"></script>';
        echo '<script src="' . $vjconfig['fwbaseurl'] . 'resources/backend/modules/widget/assets/js/widget.js"></script>';

    }


}
?>