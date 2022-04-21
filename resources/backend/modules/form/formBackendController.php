<?php

class formBackendController extends BackendResourceController
{

    function __construct()
    {
        $this->addNonauthMethod("captcha");
        parent::__construct();
    }

    function action_captcha()
    {
        require_once __DIR__ . "/phptextClass.php";

        /* create class object */
        $phptextObj = new phptextClass();
        /* phptext function to genrate image with text */
        $phptextObj->phpcaptcha('#162453', '#fff', 120, 40, 5, 15);
    }
}
?>