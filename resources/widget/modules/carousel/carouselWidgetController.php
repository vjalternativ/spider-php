<?php
class carouselWidgetController extends WidgetResourceController {


    function __construct() {

        parent::__construct();
        $this->registerField("image", "file");
        $this->loadresource("css", "carouselWidget.css");
    }
    public function processWidgetParams($params)
    {

        return $params;
    }






}
?>