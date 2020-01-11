<?php
require_once __DIR__.'/framework.php';
class SpiderRestFramework extends SpiderPhpFramework {
    function __construct($sessionName = false) {
        $_REQUEST['spiderphp_mode'] = 'REST';
        parent::__construct($sessionName);
    }
    
}
?>