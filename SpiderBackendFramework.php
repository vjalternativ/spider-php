<?php
require_once __DIR__.'/framework.php';
class SpiderBackendFramework extends SpiderPhpFramework {
    function __construct() {
        $_REQUEST['spiderphp_mode'] = 'BACKEND';
        parent::__construct();
    }    
}
?>