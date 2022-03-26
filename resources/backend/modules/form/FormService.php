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
        $module = $form->getForModule();
        $data = $form->getFormData();
        $fields = $form->getFields();

        $virtualfields = array();
        foreach ($fields as $name => $field) {

            if (isset($field['virtualfield']) && $field['virtualfield']) {

                $field['data'] = $data[$name];
                $virtualfields[$name] = $field;
                unset($data[$name]);
            }
        }

        $files = $form->getFormFiles();
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
    }
}
?>