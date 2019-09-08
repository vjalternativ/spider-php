<?php 

if(isset($_REQUEST['file'])) {
    require_once 'include/entrypoints/test/'.$_REQUEST['file'].'.php';
    
}
?>