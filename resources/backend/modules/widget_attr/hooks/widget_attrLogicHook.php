<?php
$fwbasepath = lib_config::getInstance()->get("fwbasepath");

class widget_attrLogicHook
{

    function beforeSave(&$data)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        $wid = false;
        if (isset($data['parent_record']) && $data['parent_record']) {

            $wid = $data['parent_record'];
        } else if ($data && $data['widget_widget_attr_1_m']) {
            $wid = $data['widget_widget_attr_1_m'];
        }

        if ($wid) {
            $entity = lib_entity::getInstance();
            $widget = $entity->get("widget", $wid);
            $fields = WidgetServiceRegistrar::getWidgetServiceInstance()->getWidgetFileds($widget['widget_type']);
            $jsonPrev = json_decode($data['description'], true);
            $json = array();

            if ($fields) {
                foreach ($fields as $field) {

                    $fieldval = "";

                    if ($field['type'] == "file") {

                        if (isset($_FILES[$field['name']]) && $_FILES[$field['name']]['error'] == "0") {

                            if (isset($jsonPrev[$field['name']]) && $jsonPrev[$field['name']]) {
                                $mediaKeyValue = $entity->get("media_files", $jsonPrev[$field['name']]);
                                if ($mediaKeyValue) {
                                    $mediaKeyValue['deleted'] = 1;
                                    $entity->save("media_files", $mediaKeyValue);
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
                        } else {
                            $fieldval = isset($jsonPrev[$field['name']]) ? $jsonPrev[$field['name']] : "";
                        }
                    } else {
                        $fieldval = $_REQUEST[$field['name']];
                    }

                    $json[$field['name']] = $fieldval;
                }
            }

            $data['description'] = json_encode($json);
        }
    }
}

?>