<?php
$dir = __DIR__ . '/';
require_once $dir . '../../libs/lib_current_user.php';
require_once $dir . 'CLIService.php';

class CliResourceController
{

    use CLIService;

    function __construct()
    {}

    function readjson($file)
    {
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), 1);
        } else {
            throw new Exception("invalid file path ");
        }
    }
}
?>