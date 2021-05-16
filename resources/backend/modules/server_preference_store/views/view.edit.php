<?php

class server_preference_storeViewEdit extends ViewEdit
{

    function preDisplay()
    {
        parent::preDisplay();

        if ($this->data['id'] && $this->data['type']) {
            $this->def['fields']['description']['type'] = $this->data['type'];
        }
    }

    function afterDisplay()
    {
        parent::afterDisplay();

        $vjconfig = lib_config::getInstance()->getConfig();

        echo '<script src="' . $vjconfig['baseurl'] . 'spider-php/thirdparty/client/ckeditor/ckeditor.js?v=1"></script>';
        echo '<link rel="stylesheet" href="' . $vjconfig['baseurl'] . 'spider-php/thirdparty/client/ckeditor/ckeditor.css" />';
        echo '<script src="' . $vjconfig['baseurl'] . 'spider-php/thirdparty/client/ckeditor/ckeditorinit.js?v=3"></script>';
    }
}
?>