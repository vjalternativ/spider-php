<?php
require_once lib_config::getInstance()->get('fwbasepath') . 'thirdparty/server/PHPMailer-master/src/PHPMailer.php';

class mailCliController extends CliResourceController
{

    function action_processEmailBuffer()
    {
        MailService::getInstance()->processEmailBuffer();
    }
}
?>