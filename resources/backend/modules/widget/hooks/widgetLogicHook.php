<?php
require_once __DIR__ . '/../WidgetRuntime.php';

class widgetLogicHook
{

    function beforeSave(&$data)
    {
        $entity = lib_entity::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $widgetService = WidgetServiceRegistrar::getWidgetServiceInstance();
        $fields = $widgetService->getWidgetConfigFields($data['widget_type']);

        $json = array();
        if ($fields) {
            foreach ($fields as $field) {
                $fieldval = "";
                if ($field['type'] == "file") {
                    $desc = json_decode($data['description'], 1);
                    if ($desc) {
                        $fieldval = $desc[$field['name']];
                    }
                    if (isset($_FILES[$field['name']]) && $_FILES[$field['name']]['error'] == "0") {
                        if ($fieldval) {
                            $mediaKeyValue = $entity->get("media_files", $fieldval);
                            if (isset($mediaKeyValue['file_path'])) {
                                unlink($mediaKeyValue['file_path']);
                            }
                        }

                        $mediaKeyValue = array();
                        $fileId = lib_util::create_guid();
                        $dir = $vjconfig['basepath'] . "media_files/" . date("Y") . '/' . date("m") . '/' . date("d") . '/' . $_FILES[$field['name']]['type'];
                        if (! is_dir($dir)) {
                            mkdir($dir, 0755, true);
                        }
                        $target = $dir . '/' . $fileId;
                        $tmp = $_FILES[$field['name']]['tmp_name'];
                        move_uploaded_file($tmp, $target);

                        $mediaKeyValue['name'] = $_FILES[$field['name']]['name'];
                        $mediaKeyValue['file_path'] = $target;
                        $mediaKeyValue['file_type'] = $_FILES[$field['name']]['type'];
                        $mediaId = $entity->save("media_files", $mediaKeyValue);
                        $fieldval = $mediaId;
                    }
                } else {
                    $fieldval = $_REQUEST[$field['name']];
                }

                $json[$field['name']] = $fieldval;
            }
        }

        $data['description'] = json_encode($json);
        WidgetRuntime::getInstance()->write();
    }
}
