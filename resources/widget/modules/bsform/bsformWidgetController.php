<?php
require_once lib_config::getInstance()->get("fwbasepath") . 'libs/lib_bootstrap.php';
require_once lib_config::getInstance()->get("fwbasepath") . 'resources/backend/modules/media_files/MediaFilesService.php';

class bsformWidgetController extends WidgetResourceController
{

    function __construct()
    {}

    function processWidgetParams($params)
    {
        $params['layout'] = $this->getDefaultLayout($params);

        return $params;
    }

    private function asBSFormMeta(BSFormMetaData $ob)
    {
        return $ob;
    }
}
?>