<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'resources/backend/modules/media_files/MediaFilesServiceRegistrar.php';

class media_filesBackendController extends BackendResourceController
{

    function __construct()
    {
        $this->nonauth['download'] = '';
        parent::__construct();
    }

    private function readFile($path, $name, $filetype)
    {
        if (file_exists($path)) {} else {
            echo $path . " not exist";
            die();
        }
        header('Content-Disposition: filename="' . $name . '"');
        header('Content-type: ' . $filetype);
        readfile($path);
    }

    function action_download()
    {
        $entity = lib_entity::getInstance();
        ob_end_clean();
        if (isset($_REQUEST['path'])) {

            $path = $_REQUEST['path'];
            $name = $_REQUEST['name'];
            $filetype = $_REQUEST['filetype'];
            $this->readFile($path, $name, $filetype);
        } else if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $media = $entity->get("media_files", $id);
            $url = $media['file_path'];
            $this->readFile($url, $media['name'], $media['file_type']);
        }
    }

    function action_uploadMediaFile()
    {
        MediaFilesServiceRegistrar::getInstance()->saveMediaFileByFieldName("file", array());
        lib_util::redirect("media_files");
    }
}