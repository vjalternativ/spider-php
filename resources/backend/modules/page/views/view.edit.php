<?php

class pageViewEdit extends ViewEdit
{

    function display()
    {
        parent::display();
    }

    function afterDisplay()
    {
        $fwbaseurl = lib_config::getInstance()->get("fwbaseurl");
        echo '<script src="' . $fwbaseurl . 'thirdparty/client/ckeditor/ckeditor.js"></script>';
        // echo '<link rel="stylesheet" href="resources/backend/modules/page/assets/css/edit.css" />';
        echo '<script src="' . $fwbaseurl . 'resources/backend/modules/page/assets/js/edit.js"></script>';
    }
}
?>