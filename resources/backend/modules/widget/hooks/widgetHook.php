<?php 
require_once 'include/vjlib/abstract/AWidget.php';
class widgetLogicHook {
    
    function beforeSave(&$data) {
            global $entity,$vjconfig;
            $fields = AWidget::getWidgetConfigFields($data['widget_type']);
            
            $json = array();
            if($fields) {
                foreach($fields as $field) {
                    $fieldval = "";
                    if($field['type']=="file") {
                        
                        //handle for existing
                        /* if(!data['isnew'] || !empty($keyvalue[$field['name']])) {
                            $mediaKeyValue = $entity->get("media_files",$keyvalue[$field['name']]);
                            if(isset($mediaKeyValue['file_path'])) {
                                
                                unlink($mediaKeyValue['file_path']);
                            }
                        } */
                        
                        $mediaKeyValue = array();
                        $fileId = create_guid();
                        $dir = $vjconfig['basepath']."media_files/".date("Y").'/'.date("m").'/'.date("d").'/'.$_FILES[$field['name']]['type'];
                        if(!is_dir($dir)) {
                            mkdir($dir, 0755, true);
                        }
                        $target = $dir.'/'.$fileId;
                        $tmp = $_FILES[$field['name']]['tmp_name'];
                        move_uploaded_file($tmp, $target);
                        
                        $mediaKeyValue['name'] =$_FILES[$field['name']]['name'];
                        $mediaKeyValue['file_path'] = $target;
                        $mediaKeyValue['file_type'] = $_FILES[$field['name']]['type'];
                        $mediaId  = $entity->save("media_files",$mediaKeyValue);
                        
                        $fieldval = $mediaId;
                    }   else {
                        $fieldval = $_REQUEST[$field['name']];
                    }
                    
                    $json[$field['name']] = $fieldval;
                }
            }
            
            $data['description'] = json_encode($json);
            
    }
}
        