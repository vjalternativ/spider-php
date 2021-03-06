<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'resources/backend/modules/media_files/MediaFilesServiceRegistrar.php';

class media_filesViewDetail extends ViewDetail
{

    function preDisplay()
    {
        parent::preDisplay();

        $this->data['file_path'] = '<a href="' . MediaFilesServiceRegistrar::getInstance()->getMediaLink($this->data['id']) . '">Download</a>';
    }
}
?>