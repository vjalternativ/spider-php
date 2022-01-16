<?php
require_once __DIR__ . '/IMediaFilesService.php';

class MediaFilesService implements IMediaFilesService
{

    private static $instance = null;

    private function __construct()
    {}

    private static function asIMediaFilesService(IMediaFilesService $ob)
    {
        return $ob;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new MediaFilesService();
        }
        return self::asIMediaFilesService(self::$instance);
    }

    public function saveMediaFileByFieldName($fieldName, $keyvalue)
    {
        $field = array();
        $field['name'] = $fieldName;
        return $this->saveMediaFileByFieldArray($field, $keyvalue);
    }

    public function saveMediaFileByFieldArray($field, $keyvalue)
    {
        $entity = lib_entity::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $mediaId = false;
        if (isset($_FILES[$field['name']]) && $_FILES[$field['name']]['error'] == '0') {
            $mediaKeyValue = array();
            if ((! isset($keyvalue['isnew']) || ! $keyvalue['isnew']) && ! empty($keyvalue[$field['name']])) {
                $mediaKeyValue = $entity->get("media_files", $keyvalue[$field['name']]);
                if (isset($mediaKeyValue['file_path'])) {

                    unlink($mediaKeyValue['file_path']);
                }
            }
            $fileId = lib_util::create_guid();
            $dir = $vjconfig['storage_basepath'] . "media_files/" . date("Y") . '/' . date("m") . '/' . date("d") . '/' . $_FILES[$field['name']]['type'];
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
        }
        return $mediaId;
    }

    public function getMediaLink($mediaId)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        return $mediaId ? $vjconfig['urlbasepath'] . "backend/index.php?module=media_files&action=download&id=" . $mediaId : false;
    }

    public function removeMedia($id)
    {
        $media = lib_entity::getInstance()->get("media_files", $id);
        if ($media) {
            $filePath = $media['file_path'];
            unlink($filePath);
        }
        $sql = "DELETE FROM media_files where id = '" . $id . "'";
        lib_database::getInstance()->query($sql);
    }

    public function getMediaLinkForPath($path, $name, $filetype)
    {
        $vjconfig = lib_config::getInstance()->getConfig();
        return $path ? $vjconfig['urlbasepath'] . "backend/index.php?module=media_files&action=download&path=" . $path . "&name=" . $name . "&filetype=" . $filetype : false;
    }
}
?>