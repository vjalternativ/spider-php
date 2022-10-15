<?php

class htmlWidgetController extends WidgetResourceController
{

    function __construct()
    {
        parent::__construct();
        $this->registerConfigField("content", "editor", 12);
    }
}
?>