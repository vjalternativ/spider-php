<?php
require_once lib_config::getInstance()->get('fwbasepath') . 'resources/cli/modules/mail/MailService.php';

class mailCliController extends CliResourceController
{

    function action_processEmailBuffer()
    {
        MailService::getInstance()->processEmailBuffer();
    }
}
?>