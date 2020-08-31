<?php
class media_filesController extends VJController  {
    
    function __construct() {
        $this->nonauth['download'] = '';
    }
    
    function action_download() {
       global $entity;
       ob_end_clean();
       $id = $_REQUEST['id'];
       $media = $entity->get("media_files",$id);
       $url = $media['file_path'];
       header('Content-Disposition: filename="'.$media['name'].'"');
       header('Content-type: '.$media['file_type']);
       readfile($url);
       
    }
    
    
    
    
}