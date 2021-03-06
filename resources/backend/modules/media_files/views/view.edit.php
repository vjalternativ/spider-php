<?php

class media_filesViewEdit extends ViewEdit
{

    function display()
    {
        if (isset($_REQUEST['record'])) {
            parent::display();
        } else {
            $this->displayTpl("mediafileuploader.tpl");
        }
    }
}

?>