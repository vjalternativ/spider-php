<?php

class chartjsWidgetController extends WidgetResourceController
{

    function __construct()
    {
        parent::__construct();
        $this->loadresource("js", "assets/chartjs/dist/Chart.bundle.min.js");
        $this->loadresource("css", "assets/chartjs/dist/Chart.min.css");
        $this->loadresource("js", "assets/js/chartjs.js");
    }
}
?>