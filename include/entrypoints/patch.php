<?php 
class PatchInstaller {
    function executePatch() {
        global $entity;
        
        $fields = array();
        $fields['file_type']['name'] =  'file_type';
        $fields['file_type']['type'] =  'varchar';
        $fields['file_type']['required'] =  true;
        $fields['file_type']['label'] =  "Type";
        $fields['file_type']['len'] =  '255';
        
        
        $fields['file_path']['name'] =  'file_path';
        $fields['file_path']['type'] =  'text';
        $fields['file_path']['required'] =  true;
        $fields['file_path']['label'] =  "Path";
       
        $metafields = array();
        $metafields['listview']['file_type'] =  $fields['file_type'];
        $metafields['detailview']['hr']=  array("label" => 'Other Fields','type'=>'hr');
        $metafields['detailview']['file_type']=  array("fields" => array(array('field'=>$fields['file_type'],'gridsize'=>6)),'type'=>'row');
        $entity->createEntity('media_files',array('type'=>'basic','fields'=>$fields,'metadata'=>$metafields,"label"=>"Media Files"));
        
        
        
        
        
    }
}
$patch = new PatchInstaller();
$patch->executePatch();
?>