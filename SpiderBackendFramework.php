<?php
require_once __DIR__.'/framework.php';
class SpiderBackendFramework extends SpiderPhpFramework {
    function __construct($sessionName=false) {
        $_REQUEST['spiderphp_mode'] = 'BACKEND';
        parent::__construct($sessionName);
    }    
}
?>