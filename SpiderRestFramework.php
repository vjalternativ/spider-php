<?php
require_once __DIR__.'/framework.php';
class SpiderRestFramework extends SpiderPhpFramework {
    function __construct() {
        $_REQUEST['spiderphp_mode'] = 'rest';
        parent::__construct();
    }    
}
?>