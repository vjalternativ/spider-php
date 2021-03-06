<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'resources/backend/modules/media_files/MediaFilesServiceRegistrar.php';

class media_filesBackendController extends BackendResourceController
{

    function __construct()
    {
        $this->nonauth['download'] = '';
        parent::__construct();
    }

    function action_download()
    {
        $entity = lib_entity::getInstance();
        ob_end_clean();
        $id = $_REQUEST['id'];
        $media = $entity->get("media_files", $id);
        $url = $media['file_path'];
        header('Content-Disposition: filename="' . $media['name'] . '"');
        header('Content-type: ' . $media['file_type']);
        readfile($url);
    }

    function action_uploadMediaFile()
    {
        MediaFilesServiceRegistrar::getInstance()->saveMediaFileByFieldName("file", array());
        lib_util::redirect("media_files");
    }
}