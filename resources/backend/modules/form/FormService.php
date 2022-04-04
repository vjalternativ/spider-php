<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'resources/backend/modules/media_files/MediaFilesService.php';

class FormService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new FormService();
        }
        return self::$instance;
    }

    function saveForm(HTMLFormProcessor $form)
    {
        for ($i = $form->getFormIndex(); $i < $form->getFormLength(); $i ++) {

            $this->_saveForm($form, $i);
        }
    }

    private function _saveForm(HTMLFormProcessor $form, $index)
    {
        $module = $form->getForModule();
        $data = $form->getFormData();
        $files = $form->getFormFiles();
        if ($form->getFormType() == "multiple") {

            if (isset($data[$module])) {
                $data = $data[$module];

                $row = array();
                foreach ($data as $key => $val) {
                    if ($index == substr($key, strlen($key) - strlen($index))) {
                        $row[substr($key, 0, strlen($key) - strlen($index) - 1)] = $val;
                    }
                }
                $data = $row;
            }
            if (isset($files[$module])) {
                $files = $files[$module];

                $row = array();
                foreach ($files as $key => $val) {
                    if ($index == substr($key, strlen($key) - strlen($index))) {
                        $row[substr($key, 0, strlen($key) - strlen($index) - 1)] = $val;
                    }
                }
                $files = $row;
            }
        }

        $isvalid = false;
        foreach ($data as $key => $val) {
            if ($val) {
                $isvalid = true;
                break;
            }
        }

        if (($form->getFormType() == "multiple" && $isvalid) || $form->getFormType() != "multiple") {
            $fields = $form->getFields();

            $virtualfields = array();
            foreach ($fields as $name => $field) {

                if (isset($field['virtualfield']) && $field['virtualfield']) {

                    $field['data'] = $data[$name];
                    $virtualfields[$name] = $field;
                    unset($data[$name]);
                }
            }

            foreach ($files as $file => $filedata) {
                $data[$file] = MediaFilesService::getInstance()->saveMediaFileByFieldName($file);
                $files[$file] = $filedata;
            }

            $id = lib_entity::getInstance()->save($module, $data);
            foreach ($virtualfields as $field) {

                if ($field['type'] == "multienum") {

                    if (isset($field['relationship'])) {

                        if (isset($field['data'])) {
                            foreach ($field['data'] as $val) {

                                lib_entity::getInstance()->saveRelationship($field['relationship'], $id, $val);
                            }
                        }
                    }
                }
            }
            if ($form->getFormType() == "multiple") {

                $relationship = $form->getParentRelationship();
                $parentId = $form->getParentId();
                if ($relationship && $parentId) {
                    lib_entity::getInstance()->saveRelationship($relationship, $parentId, $id);
                }
            }
        }
    }
}
?>