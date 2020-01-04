<?php  
class Installer {
	
	
	
	function createAdmin() {
		global $entity,$db;
		$user = $db->getrow("select * from user where user_name = 'vjalternativ' and deleted=0 ");
		if(!$user) {
    		$keyvalue = array();
    		$keyvalue['name'] = "developer";
    		$keyvalue['user_name'] = "vjalternativ";
    		$keyvalue['user_hash'] = md5("workst@48");
    		$keyvalue['user_type'] = 'developer';
    		$entity->save('user',$keyvalue);
		}
	}
	
	function createusertable() {
		global $entity;
		$fields = array();
		$fields['user_name']['name'] =  'user_name';
		$fields['user_name']['type'] =  'varchar';
		$fields['user_name']['len'] =  '255';
		$fields['user_name']['notnull'] =  true;
		$fields['user_name']['label'] =  "Username";
		
		$fields['user_hash']['name'] =  'user_hash';
		$fields['user_hash']['type'] =  'md5';
		$fields['user_hash']['len'] =  '255';
		$fields['user_hash']['notnull'] =  true;
		$fields['user_hash']['label'] =  "Password";
		
		$fields['user_type']['name'] =  'user_type';
		$fields['user_type']['type'] =  'varchar';
		$fields['user_type']['len'] =  '255';
		$fields['user_type']['notnull'] =  true;
		$fields['user_type']['label'] =  "User Type";

		
		$entity->createEntity('user',array('fields'=>$fields,'type'=>'basic',"label"=>"Users"));
	}
	
	
	function createtableinfo() {
    	global $entity;
    	$fields  = array();
    	$fields['label']['name'] =  'label';
    	$fields['label']['type'] =  'varchar';
    	$fields['label']['len'] =  '255';
    	$fields['label']['notnull'] =  true;
    	$fields['label']['label'] =  "Label";
    	
	
	    $fields['tabletype']['name'] =  'tabletype';
		$fields['tabletype']['type'] =  'enum';
		$fields['tabletype']['notnull'] =  true;
		$fields['tabletype']['label'] =  "Table Type";
		$fields['tabletype']['options'] =  "tabletype_list";
		 
		$metafields = array();
		$metafields['listview']['tabletype'] =  $fields['tabletype'];
		$metafields['listview']['label'] =  $fields['label'];
		$metafields['detailview']['label'] =  array("fields" => array(array('field'=>$fields['label'],'gridsize'=>6),array('field'=>$fields['tabletype'],'gridsize'=>6)),'type'=>'row');
		$metafields['editview']['label'] =  array("fields" => array(array('field'=>$fields['label'],'gridsize'=>6)),'type'=>'row');
		$metafields['editview']['tabletype'] =  array("fields" => array(array('field'=>$fields['tabletype'],'gridsize'=>6)),'type'=>'row');
		$entity->createEntity('tableinfo',array('type'=>'basic',"label"=>"Modules",'fields'=>$fields,'metadata'=>$metafields,'skiptableinfoentry'=>true));
		
	}
	
	function createrelationshiptable() {
		global $entity;
		$fields  = array();
		$fields['primarytable']['name'] =  'primarytable';
		$fields['primarytable']['type'] =  'relate';
		$fields['primarytable']['rmodule'] =  'tableinfo';
		$fields['primarytable']['notnull'] =  true;
		$fields['primarytable']['label'] =  "Primary Module";
		
		$fields['secondarytable']['name'] =  'secondarytable';
		$fields['secondarytable']['type'] =  'relate';
		$fields['secondarytable']['rmodule'] =  'tableinfo';
		$fields['secondarytable']['notnull'] =  true;
		$fields['secondarytable']['label'] =  "Secondary Module";
		
		
		$fields['primarytable_name']['name'] =  'primarytable_name';
		$fields['primarytable_name']['type'] =  'varchar';
		$fields['primarytable_name']['len'] =  '255';
		$fields['primarytable_name']['label'] =  "Primary Relationship Name";
		
		
		$fields['secondarytable_name']['name'] =  'secondarytable_name';
		$fields['secondarytable_name']['type'] =  'varchar';
		$fields['secondarytable_name']['len'] =  '255';
		$fields['secondarytable_name']['label'] =  "Secondary Relationship Name";
		
		
		$fields['rtype']['name'] =  'rtype';
		$fields['rtype']['type'] =  'enum';
		$fields['rtype']['notnull'] =  true;
		
		$fields['rtype']['label'] =  "Relationship Type";
		$fields['rtype']['options'] =  'relationship_type_list';
		
		$metafields = array();
		$metafields['listview']['primarytable'] =  $fields['primarytable'];
		$metafields['listview']['secondarytable'] =  $fields['secondarytable'];
		$metafields['listview']['rtype'] =  $fields['rtype'];
	
		$metafields['editview']['hr'] =  array("label" => 'Other Fields','type'=>'hr');
		$metafields['editview']['primarytable'] =  array("fields" => array(array('field'=>$fields['primarytable'],'gridsize'=>12)),'type'=>'row');
		$metafields['editview']['secondarytable'] =  array("fields" => array(array('field'=>$fields['secondarytable'],'gridsize'=>12)),'type'=>'row');
		$metafields['editview']['rtype'] =  array("fields" => array(array('field'=>$fields['rtype'],'gridsize'=>12)),'type'=>'row');
	
		$metafields['detailview']['hr']=  array("label" => 'Other Fields','type'=>'hr');
		$metafields['detailview']['primarytable']=  array("fields" => array(array('field'=>$fields['primarytable'],'gridsize'=>12)),'type'=>'row');
		$metafields['detailview']['secondarytable']=  array("fields" => array(array('field'=>$fields['secondarytable'],'gridsize'=>12)),'type'=>'row');
		$metafields['detailview']['rtype']=  array("fields" => array(array('field'=>$fields['rtype'],'gridsize'=>12)),'type'=>'row');
		
		$entity->createEntity('relationships',array('fields'=>$fields,'type'=>'basic_wod','metadata'=>$metafields));
		
		
		$entity->createRelationship('tableinfo','relationships','1_M',"Module","Relationships");
	
	
	}
	
	
	function createrolestable() {
	    global $entity;
		$entity->createEntity('roles');
		
		$fields  = array();
		
		$fields['module_access']['name'] =  'module_access';
		$fields['module_access']['type'] =  'enum';
		$fields['module_access']['notnull'] =  true;
		$fields['module_access']['label'] =  "List";
		$fields['module_access']['options'] =  "role_access_list";
		
		$fields['list_access']['name'] =  'list_access';
		$fields['list_access']['type'] =  'enum';
		$fields['list_access']['notnull'] =  true;
		$fields['list_access']['label'] =  "List";
		$fields['list_access']['options'] =  "role_access_list";
		
		
		$fields['edit_access']['name'] =  'edit_access';
		$fields['edit_access']['type'] =  'enum';
		$fields['edit_access']['notnull'] =  true;
		$fields['edit_access']['label'] =  "Edit";
		$fields['edit_access']['options'] =  "role_access_list";
		
		
		$fields['delete_access']['name'] =  'delete_access';
		$fields['delete_access']['type'] =  'enum';
		$fields['delete_access']['notnull'] =  true;
		$fields['delete_access']['label'] =  "Delete";
		$fields['delete_access']['options'] =  "role_access_list";
		
		
		$fields['module_id']['name'] =  'module_id';
		$fields['module_id']['type'] =  'relate';
		$fields['module_id']['rmodule'] =  'tableinfo';
		$fields['module_id']['notnull'] =  true;
		$fields['module_id']['label'] =  "Module";
		
		$fields['role_id']['name'] =  'role_id';
		$fields['role_id']['type'] =  'relate';
		$fields['role_id']['rmodule'] =  'roles';
		$fields['role_id']['notnull'] =  true;
		$fields['role_id']['label'] =  "Role";
		
		$entity->createEntity('roles_item',array("fields"=>$fields));
	//	$entity->createRelationship('roles','roles_item','1_M',"Roles","Role Items");
		$entity->createRelationship('roles','user','1_M',"Roles","Users");
		
		$entity->createEntity('privilege');
		
		$entity->createRelationship('roles','privilege','1_M',"Role","Privileges");
		
		
		
	}
	
	function install() {
	
		global $entity;
		$this->createtableinfo();
		$this->createrelationshiptable();
		$this->createusertable();
		$this->createrolestable();
		$this->createAdmin();
		
		
		
		$entity->createEntity('server_context',array("label"=>"Server Context"));
		$entity->createEntity('server_preference_store',array("label"=>"Configurations"));
		$entity->createRelationship('server_context','server_preference_store','1_M',"Server Context","Prefrences");
		$keyvalue=array();
		$keyvalue['name'] = "system";
		$entity->save("server_context",$keyvalue);
		
		
		
		
		
		$fields = array();
		$fields['parent_category_id']['name'] =  'parent_category_id';
		$fields['parent_category_id']['type'] =  'relate';
		$fields['parent_category_id']['rmodule'] =  'category';
		$fields['parent_category_id']['required'] =  true;
		$fields['parent_category_id']['label'] =  "Parent Category";
		
		$metafields = array();
		$metafields['listview']['parent_category_id'] =  $fields['parent_category_id'];
		
		$metafields['editview']['hr'] =  array("label" => 'Other Fields','type'=>'hr');
		$metafields['editview']['parent_category_id'] =  array("fields" => array(array('field'=>$fields['parent_category_id'],'gridsize'=>12)),'type'=>'row');
		
		$metafields['detailview']['hr']=  array("label" => 'Other Fields','type'=>'hr');
		$metafields['detailview']['parent_category_id']=  array("fields" => array(array('field'=>$fields['parent_category_id'],'gridsize'=>12)),'type'=>'row');
		
		$entity->createEntity('category',array('type'=>'basic','fields'=>$fields,'metadata'=>$metafields));
		
		$fields = array();
		$fields['task_category_id']['name'] =  'task_category_id';
		$fields['task_category_id']['type'] =  'relate';
		$fields['task_category_id']['notnull'] =  true;
		$fields['task_category_id']['rmodule'] =  'category';
		$fields['task_category_id']['required'] =  true;
		$fields['task_category_id']['label'] =  "Task Category";
	
		$metafields = array();
		$metafields['listview']['task_category_id'] =  $fields['task_category_id'];
		
		$metafields['editview']['hr'] =  array("label" => 'Other Fields','type'=>'hr');
		$metafields['editview']['task_category_id'] =  array("fields" => array(array('field'=>$fields['task_category_id'],'gridsize'=>12)),'type'=>'row');
		
		$metafields['detailview']['hr']=  array("label" => 'Other Fields','type'=>'hr');
		$metafields['detailview']['task_category_id']=  array("fields" => array(array('field'=>$fields['task_category_id'],'gridsize'=>12)),'type'=>'row');
		
		
		$entity->createEntity('task',array('type'=>'basic','fields'=>$fields,'metadata'=>$metafields));
		$entity->createRelationship('category','task','1_M',"Category","Tasks");
		
		$entity->createEntity('menu',array('type'=>'basic','fields'=>array(),'metadata'=>array()));
		$entity->createRelationship('menu','tableinfo','1_M',"Menu","Modules");
		
		
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
		
	   	$entity->createEntity("language");
		$entity->createRelationship('tableinfo','language','M_M',"Modules","Languages");
		
		
		$fields = array();
		$fields['position']['name'] =  'position';
		$fields['position']['type'] =  'varchar';
		$fields['position']['required'] =  false;
		$fields['position']['label'] =  "Alias";
		$fields['position']['len'] =  '255';
		
		
		$fields['status']['name'] =  'status';
		$fields['status']['type'] =  'enum';
		$fields['status']['label'] =  "Status";
		$fields['status']['options'] =  "status_list";
		
		$metafields = array();
		$metafields['listview']['status'] =  $fields['status'];
		$metafields['listview']['position'] =  $fields['position'];
		
		$metafields['editview']['alias'] =  array("fields" => array(array('field'=>$fields['status'],'gridsize'=>6),array('field'=>$fields['position'],'gridsize'=>6)),'type'=>'row');
		$metafields['detailview']['alias'] =  array("fields" => array(array('field'=>$fields['status'],'gridsize'=>6),array('field'=>$fields['position'],'gridsize'=>6)),'type'=>'row');
		
		$entity->createEntity('widget',array('type'=>'basic','fields'=>$fields,'metadata'=>$metafields,"label"=>"Page"));
		
		
		$entity->createEntity("widget_attr");
		$entity->createRelationship('widget','widget_attr','1_M',"Widget","Widget Attrs");
		
		
		$fields = array();
		$fields['alias']['name'] =  'alias';
		$fields['alias']['type'] =  'varchar';
		$fields['alias']['required'] =  false;
		$fields['alias']['label'] =  "Alias";
		$fields['alias']['len'] =  '255';
		
		$metafields = array();
		$metafields['listview']['alias'] =  $fields['alias'];
		$metafields['editview']['alias'] =  array("fields" => array(array('field'=>$fields['alias'],'gridsize'=>6)),'type'=>'row');
		$metafields['detailview']['alias'] =  array("fields" => array(array('field'=>$fields['alias'],'gridsize'=>6)),'type'=>'row');
		
		$entity->createEntity('page',array('type'=>'basic','fields'=>$fields,'metadata'=>$metafields,"label"=>"Page"));
		
		
		$entity->createRelationship('page','widget','M_M',"Pages","Widgets");
		
		
		$entity->createEntity("outbound_email_context");
		$entity->createEntity("submenu");
		$entity->createRelationship('menu','submenu','1_M',"Menu","Submenus");
		$entity->createRelationship('submenu','tableinfo','1_M',"Submenu","Modules");
		
		global $vjconfig;
		$dir = $vjconfig['fwbasepath']."include/entrypoints/install";
		$files = scandir($dir);
		if($files) {
		    foreach($files as $file) {
		        if(strlen($file)>2) {
		            require_once $dir."/".$file;
		        }
		    }
		}
		
		
	}
	
	
	
	
	
	
}
$framework = new Installer();
$framework->install();
?>