<?php

class media_filesLogicHook
{

    function beforeSave(&$data)
    {
        if (isset($data['deleted']) && $data['deleted'] == "1" && isset($data['file_path']) && file_exists($data['file_path'])) {
            unset($data['file_path']);
        }
    }
}
?>