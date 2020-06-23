<?php 
trait MediaFilesService  {
    
    function saveMediaFileByFieldName($fieldName,$keyvalue) {
        $field = array();
        $field['name'] = $fieldName;
        return $this->saveMediaFileByFieldArray($field, $keyvalue);
    }
    
    function saveMediaFileByFieldArray($field,$keyvalue) {
        global $entity,$vjconfig;
        $mediaKeyValue=array();
        
        if(!$keyvalue['isnew'] || !empty($keyvalue[$field['name']])) {
            $mediaKeyValue = $entity->get("media_files",$keyvalue[$field['name']]);
            if(isset($mediaKeyValue['file_path'])) {
                
                unlink($mediaKeyValue['file_path']);
            }
        }
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
        return $mediaId;
    }
    
    
    
}
?>