<?php
class Entity {
	public $id =array('name'=>'id','type'=>'id','notnull'=>true,'label'=>'LBL_ID'); 
	public $name = array('name'=>'name','type'=>'varchar','len'=>255,'link'=>true,'label'=>'LBL_NAME');
	public $description = array('name'=>'description','type'=>'text','label'=>'LBL_DESCRIPTION');
	public $date_entered = array('name'=>'date_entered','type'=>'datetime','notnull'=>true,'label'=>'LBL_DATE_ENTERED');
	public $date_modified = array('name'=>'date_modified','type'=>'datetime','notnull'=>true,'label'=>'LBL_DATE_MODIFIED');
	public $deleted = array('name'=>'deleted','type'=>'int','default'=>0,'label'=>'LBL_DELETED');
	public $modified_user_id = array('name'=>'modified_user_id','type'=>'relate','rmodule'=>'user','notnull'=>true,'label'=>'LBL_MODIFIED_USER_ID');
	public $created_by = array('name'=>'created_by','type'=>'relate','rmodule'=>'user','notnull'=>true,'label'=>'LBL_CREATED_BY');
	public $instanceType  = array('db'=>array('type'=>'Mysqli','engine'=>'InnoDB'));
	public $assigned_user_id = array('name'=>'assigned_user_id','type'=>'relate','rmodule'=>'user','notnull'=>true,'label'=>'LBL_ASSIGNED_USER_ID');
	public $basicExcludeFields = array();
	public $basic_wodExcludeFields = array('assigned_user_id','description');
	public $relationshipExcludeFields = array('name','assigned_user_id','description','date_entered','modified_user_id','created_by');
	
	public $data;
	public $beandata;
	public $relationships = array();
	public $module;
	public $record;
	public $tableinfo = array();
	public $fields = array();
	public $defaultFields = array();
	public $hookTable = "";
	
	public $username = array('name'=>'username','type'=>'varchar','len'=>255,'label'=>'LBL_USERNAME');
	public $password = array('name'=>'password','type'=>'varchar','len'=>255,'label'=>'LBL_PASSWORD');
	public $ownership_id = array('name'=>'ownership_id','type'=>'relate','rmodule'=>'user','notnull'=>true,'label'=>'LBL_OWNERSHIP');
	
	
	public $user_additonalFields = array("username","password","ownership_id");
	public $userExcludeFields = array("description");
	function __construct() {
		$this->defaultFields = array('id','name','description','date_entered','date_modified','deleted','modified_user_id','created_by','assigned_user_id');
		$fields = array();
		foreach($this->defaultFields as $field) {
			$fields[$field]= $this->$field;
		}
		$this->fields = $fields;
	}
	
	
	
	function getDefaultFields($type='framework') {
		$fields = $this->fields;
			if($type) {
			$exclude = $this->{$type.'ExcludeFields'};
			foreach ($exclude as $excludefield) {
				unset($fields[$excludefield]);
			}
			if($type=="user") {
			    foreach ($this->user_additonalFields as $field) {
			        $fields[$field] = $this->{$field};
			    }
			}
		}
		return $fields;
	}
	
	
	
	
	function createEntity($entityName,$params=array(),$repair=false) {
		if(isset($this->instanceType['db'])) {
		
			$result = $this->createSQLModule($entityName,$params,$repair);
			
			if(isset($params['type']) && $params['type']=="relationship") {
					$values = $params['values'];
					$label = ucfirst($entityName);
					if(!empty($params['label'])) {
					$label = $params['label'];
					}
					
					$secondlabel = '';
					if(!empty($params['secondlabel'])) {
						$secondlabel =$params['secondlabel'];
					
					}
					
					if(!$repair) {
					    $keyvalue = array("name"=>$entityName,'primarytable_name'=>$label,'secondarytable_name'=>$secondlabel,'primarytable'=>$values[0],'secondarytable'=>$values[1],'rtype'=>strtoupper($params['rtype']));
					    $relid = $this->save("relationships",$keyvalue);
					    $keyvalue = array('tableinfo_id'=>$values[0],'relationships_id'=>$relid);
					    $this->save("tableinfo_relationships_1_m", $keyvalue);
					    
					}
					
			}
		}
		
	}
	
	function convertFieldArrayToString($field) {
		
	    if($field['type']=='relate' || $field['type']=='id' || $field['type']=='dependent_relate' || $field['type']=='file') {
			$field['type'] = 'char';
			$field['len'] = 36;
		} else if($field['type']=='enum' ||  $field['type']=='md5') {
		
			$field['type'] = 'varchar';
			$field['len'] = 255;
		
		} else if($field['type']=="checkbox") {
		    $field['type']  = "int";
		    $field['len'] = 11;
 		} else if ($field['type'] == "editor") {
			$field['type'] = "text";	
		}
		
		
		$fieldstring = $field['name']." ".$field['type'];
		if(isset($field['len'])) {
			$fieldstring.="(".$field['len'].")";
		}
		if(isset($field['notnull'])) {
			$fieldstring.=" NOT NULL";
		} 
		if(isset($field['default'])) {
			$fieldstring.=" DEFAULT '".$field['default']."'";
		}
		
		
		return $fieldstring;
	}
	
function tableInfoEntry($table,$tbinfo=array(),$params=array()) {
	global $db;
	
	$metafields = array();
	
	$fields = $tbinfo['fields'];
	
	
	//$metafields['listview']['id']= $fields['id'];
	if(isset($fields['name'])) {
		$metafields['listview']['name']= $fields['name'];
		$metafields['editview']['name']=  array("fields" => array(   array( 'field'=> $fields['name'],'gridsize'=>6) ),'type'=>'row');
		$metafields['detailview']['name']=  array("fields" => array(array('field'=>$fields['name'],'gridsize'=>6)),'type'=>'row');
		$metafields['searchview']['name']= $fields['name'];
	
		
	
	}
	if(isset($fields['username'])) {
	    $metafields['listview']['username']= $fields['username'];
	    $metafields['editview']['username']=  array("fields" => array(   array( 'field'=> $fields['username'],'gridsize'=>6) ),'type'=>'row');
	    $metafields['detailview']['username']=  array("fields" => array(array('field'=>$fields['username'],'gridsize'=>6)),'type'=>'row');
	    $metafields['searchview']['username']= $fields['username'];
	    
	}
	
	if(isset($fields['password'])) {
	    $metafields['editview']['password']=  array("fields" => array(   array( 'field'=> $fields['password'],'gridsize'=>6) ),'type'=>'row');
	}
	if(isset($fields['ownership_id']) ) {
	    $metafields['detailview']['ownership_id']=  array("fields" => array(   array( 'field'=> $fields['ownership_id'],'gridsize'=>6) ),'type'=>'row');
	}
		
	if(isset($fields['description'])) {
	$metafields['editview']['description']=  array("fields" => array(array('field'=>$fields['description'],'gridsize'=>12)),'type'=>'row');
	$metafields['detailview']['description']=  array("fields" => array(array('field'=>$fields['description'],'gridsize'=>12)),'type'=>'row');
	}	
		
	if(isset($fields['date_entered'])) {
		$metafields['listview']['date_entered']= $fields['date_entered'];
		$metafields['detailview']['name']["fields"][1] = array('field'=>$fields['date_entered'],'gridsize'=>6);
	}
	
	
	
	
	$emetafields = array();
	if(isset($params['metadata'])) {
		$emetafields = $params['metadata'];
	}
	
	
	if(isset($emetafields['listview'])) {
		$metafields['listview']	 = array_merge_recursive($metafields['listview'],$emetafields['listview']);
	}
	
	if(isset($emetafields['detailview'])) {
		$metafields['detailview']	 = array_merge_recursive($metafields['detailview'],$emetafields['detailview']);
	}
	
	if(isset($emetafields['editview'])) {
		$metafields['editview']	 = array_merge_recursive($metafields['editview'],$emetafields['editview']);
	}
	
	
	
	
	
	
		
	
	
	
	$tbinfo['metadata'] = $metafields;
	
	$keyvalue = array();
	$keyvalue['name'] = $table;
	$type =  'basic';
	
	if(isset($params['type']) && $params['type']=='relationship') {
		$type = $params['type'];
	}
    $keyvalue['tabletype'] = $params['type'];

	$keyvalue['description'] = base64_encode(json_encode($tbinfo));


	if(isset($params['label'])) {
	    $keyvalue['label'] = $params['label'];
	    
	} else {
	    $keyvalue['label'] = ucfirst($keyvalue['name']);
	}
	
	
	

	$this->save("tableinfo", $keyvalue);
/*	
	if(isset($params['skiptableinfoentry']) && $params['skiptableinfoentry']) {
		return true;
	}
	
	foreach($fields as $field) {
		if($field['type']=='relate') {
			
				$primarytbinfo = $this->getwhere("tableinfo","name='".$table."'");
				$secondarytbinfo = $this->getwhere("tableinfo","name='".$field['rmodule']."'");
		
		
		
				$keyvalue = array();
				$keyvalue['name'] = $table."_".$field['rmodule']."_1_1";
				$keyvalue['primarytable'] = $primarytbinfo['id'];
				$keyvalue['secondarytable'] = $secondarytbinfo['id'];
				$keyvalue['rtype'] = '1_1';	
				$this->save('relationships',$keyvalue);
			
		
		}
		
	}
	
	*/
}
	
	function createSQLModule($name,$params=array(),$repair=false,$engine="InnoDB") {
		global $db;
		
		$type = false;
		$fields = array();
		
		
		if(isset($params['fields'])) {
			$fields = $params['fields'];
		}
		if(!isset($params['type'])) {
			$params['type'] = 'basic';
		}
		$type = $params['type'];
		$totalFields = $this->getDefaultFields($type);
		$sql = "CREATE TABLE ".strtolower($name)."( ";
		if($fields) {
		    $totalFields = array_merge_recursive($totalFields,$fields);
		}
		
		if($repair) {
		    $totalFields = $fields;
		}
		
		$fieldstrings = array();
		foreach($totalFields as $field) {
			if(isset($field['nondb'])) {
				continue;
			}
			if($field['type']=="nondb") {
			    continue;
			}
			$string = $this->convertFieldArrayToString($field);
			$fieldstrings[] = $string;
		}
		
		
		if(count($fieldstrings)>0) {
			$string = implode(',',$fieldstrings);
			$sql.= $string;
		}
		
		$sql.= ", PRIMARY KEY(id)) ENGINE=".$engine;
		$qry = $db->query($sql);
		
		if(!$repair) {
    		
    		$metainfo = array();
    		if(isset($params['metadata'])) {
    			$metainfo = $params['metadata'];
    		}
    		$tbinfo = array("fields"=>$totalFields);
    		$this->tableInfoEntry($name,$tbinfo,$params);
		}
		return $qry;
	}
	
	
	function getupdateByIdString($keyvalue,$isnew=true,$cols=array(),$where=false) {
		global $current_user;
	
		$sql = " SET ";
		$strings = array();
		
		// TO DO make it generic
		
		$id = "";
		if(isset($keyvalue['id'])) {
		    $id = $keyvalue['id'];
		}
		$defaultFieldSet = array();
		$defaultFieldSet['date_modified'] = 'NOW()';
		
		if(!$isnew) {
			if(empty($current_users->id)) {
				$keyvalue['modified_user_id'] = $keyvalue['id'];
			}
		
			
			unset($keyvalue['id']);
		
		} else {
			$defaultFieldSet['date_entered'] = 'NOW()';
			if(empty($current_user->id)) { 
				$keyvalue['created_by'] = $keyvalue['id'];
				$keyvalue['modified_user_id'] = $keyvalue['id'];
					
			}
			 else {
			 	$keyvalue['created_by'] = $current_user->id;
			 }
			
		}
		
		foreach ($keyvalue as $key=>$val) {
			
			if($key=='nondb' || !isset($cols[$key])) {
				continue;
			}
			$strings[] = $key."='".addslashes($val)."'";	
		}
		$sql .= implode(',',$strings);
		$strings = array();
		foreach ($defaultFieldSet as $key=>$val) {
			if(!isset($cols[$key])) {
				continue;
			}
			if(isset($keyvalue[$key])) {
			    continue;
			}
			$strings[] = $key."=".$val;
		}
		
		if(count($strings)>0) {
		$sql .=','.implode(',',$strings);
		}
		
		if(!$isnew){
		    if($where) {
		      $sql .= " WHERE ".$where;                                                              
		    } else {
		        $sql.=	" WHERE id='".$id."'";
		    }
		}
		return $sql;
			
	}
	
	
	function saveIntoDB($table,$keyvalue,$where=false,$return = false) {
	    global $db,$vjlib,$logicHook,$globalModuleList,$globalLogicHook;
	    $isnew = false;
		$sql = "UPDATE ";
		$logicHook[$table] = array("before_save"=>array(),"after_save"=>array());
		$globalLogicHook = array("before_save"=>array(),"after_save"=>array());
		
		$vjlib->loadf("include/logic_hooks.php",true,false);
		$vjlib->loadf("modules/".$table."/logic_hooks.php",false,false);
		$vjlib->loadf("custom/modules/".$table."/logic_hooks.php",false,false);
		if(isset($keyvalue['hook_skip']) && $keyvalue['hook_skip']) {
		    $logicHook[$table] = array("before_save"=>array(),"after_save"=>array());
		    $globalLogicHook = array("before_save"=>array(),"after_save"=>array());
		}
		
		if((!isset($keyvalue['id']) || empty($keyvalue['id'])) && !$where) {
			$isnew = true;
			$id = create_guid();
			$keyvalue['id'] = $id;
			$sql = "INSERT INTO ";
			foreach($keyvalue as $key=>$val) {
			    if(isset($globalModuleList[$table]['tableinfo']['fields'][$key]['field_index']) && $globalModuleList[$table]['tableinfo']['fields'][$key]['field_index']=="unique") {
			        $data  = $this->getwhere($table," ".$key." = '".$val."'" );
			        if($data) {
			            die($key." ".$val." Already Exist");
			        }
			    }
			}
		
		}
		
		
		$columns = $db->getfields($table);
		
		
		
		if(isset($keyvalue['new_with_id']) && isset($keyvalue['id'])) {
		    $isnew = true;
		    $sql = "INSERT INTO ";
		}
		$keyvalue['hook_isnew'] = $isnew;
		$keyvalue['hook_table'] = $table;
		$keyvalue['hook_tabletype'] = "basic";
		$keyvalue['hook_table_id'] = $globalModuleList[$table]['id'];
		
		if(isset($globalModuleList[$table]['tabletype'])) {
		    $keyvalue['hook_tabletype'] = $globalModuleList[$table]['tabletype'];
		    
		} 
		
		
		foreach($globalLogicHook['before_save'] as $hook) {
		    $vjlib->loadf($hook[1]);
		    $hookobj = new $hook[2];
		    
		    $this->hookTable = $table;
		    $hookobj->{$hook[3]}($keyvalue);
		}
		
		
		foreach($logicHook[$table]['before_save'] as $hook) {
		    $vjlib->loadf($hook[1]);
		    $hookobj = new $hook[2];
		    
		    $this->hookTable = $table;
		    $hookobj->{$hook[3]}($keyvalue);
		}
		
		
		$sql .= $table." ".$this->getupdateByIdString($keyvalue,$isnew,$columns,$where);
		//$log->fatal("Going to save data ".$sql);
		
		
		
		
		$qry = $db->query($sql,$return);
		if($qry) {
		    
		} else {
		    return $qry;
		}
		
		
		foreach($globalLogicHook['after_save'] as $hook) {
		    $vjlib->loadf($hook[1]);
		    $hookobj = new $hook[2];
		    $this->hookTable = $table;
		    $hookobj->{$hook[3]}($keyvalue);
		}
		
		foreach($logicHook[$table]['after_save'] as $hook) {
		    $vjlib->loadf($hook[1]);
		    $hookobj = new $hook[2];
		    $this->hookTable = $table;
		    $hookobj->{$hook[3]}($keyvalue);
		}
		
		if(isset($keyvalue['deleted']) && $keyvalue=='1') {
		    $this->removeRelationshpRows($table, $keyvalue['id']);
		}
		if($where) {
		   return true;
		}
		return $keyvalue['id'];
	}
	
	
	function removeRelationshpRows($table,$id) {
	    
	    global $globalModuleList,$db;
	    
	    if(isset($globalModuleList[$table]['relationships'])) {
	        
	        foreach($globalModuleList[$table]['relationships'] as $reltable=> $relationship) {
	                                   
	            $sql = "UPDATE ".$reltable." SET deleted=1 where ".$table."_id = '".$id."'";
	            
	            $db->query($sql);
	        }
	    }
	    
	}
	
	function save($table,$keyvalue,$where=false,$return=false) {
		
		if(isset($this->instanceType['db'])) {
			return $this->saveIntoDB($table,$keyvalue,$where,$return);
			
		}
		
		
	}
	
	function getquery($entity,$where = array()) {
		
		//need to complete
		$sql = "select * from $entity ";
		if($where) {
			$sql .= " where ";
			$strings = array();
			foreach ($where as $key=>$field) {
				
				$string = $key;
				if(isset($field['op'])) {
					$string.= $field['op'];
				}
				$string .= $field['val']; 
			
			}
		}
	}
	
	
	function get($table,$id) {
	    global $db,$globalEntityList,$globalModuleList;
		$this->module = $table;
		
		$tableinfo = $globalModuleList[$table];
	    $this->tableinfo = $tableinfo;
	   $vardef = json_decode(base64_decode($tableinfo['description']),1);
	   $fields = $vardef["fields"]; 
	   //need to check why two times
	   
	   $sql = "select * from relationships where secondarytable = '".$tableinfo['id']."' and deleted=0 and rtype='1_M'";
	   
	   $rlist  = $db->fetchRows($sql);
	   
	   foreach($rlist as $r) {
	       $fields[$r['name']]['name'] =  $r['name'];
	       $fields[$r['name']]['type'] =  'nondb';
	       $fields[$r['name']]['rmodule'] =  $globalEntityList[$r['primarytable']]['name'];
	       $fields[$r['name']]['label'] =  $r['primarytable_name'];
	   }
	   
	  
		$data =  $this->getwhere($table, "id='".$id."'");
		foreach($fields as $key => $field) {
		    if(($field['type']=="relate" || $field['type']=="dependent_relate")) {
		        $data[$key."_name"] = "";
		        if(!empty($data[$key])) {
		            $relateData =  $this->getwhere($field['rmodule'], "id='".$data[$key]."'");
		            if($relateData) {
		              $data[$key."_name"] = $relateData['name'];
		            }
		           
		        }
		       
		    } else if($field['type']=="nondb" && isset($field['rmodule'])) {
		        $data[$key] = "";
		        $data[$key."_name"] = "";
		        
		        $sql = "select ".$field['rmodule'].".* from ".$field['name']." inner join ".$field['rmodule']." on ".$field['name'].".".$field['rmodule']."_id = ".$field['rmodule'].".id and ".$field['name'].".".$table."_id='".$id."' and ".$field['rmodule'].".deleted=0 and ".$field['name'].".deleted=0";
		        $rdata = $db->fetchRows($sql,array("id"),"name");
		        foreach($rdata as $rkey=>$rname) {
		            $data[$key] = $rkey;
		            $data[$key."_name"] = $rname;
		            
		        }
		        
		    }
		   
		}
		
		
		return $data;
	}
	function getwhere($table,$wherestring=false) {
		global $db;
		$sql = "select * from ".$table." where deleted=0 ";
		if($wherestring)
		{
			$sql .= "AND ".$wherestring;
		}
		
		$data = $db->getrow($sql);
		
		return $data;
	}
	
	function gets($table,$wherestring=false,$index=false) {
		global $db;
		$sql = "select * from ".$table." where deleted=0 ";
		if($wherestring)
		{
			$sql .="AND ".$wherestring;
		}
		
		return $db->getrows($sql,$index);
	}
	function createAlias($table=false,$name=false) {
		global $db;
		if(!$table || !$name) {
			die("create alias param is incorrect for ".$table." ".$name);
		}
		$sql = "select * from ".$table." where name ='".$name."'";
		$qry = $db->query($sql);
		if($qry->num_rows==0) {
			return $name;
		}
		
		return $name.'_'. $qry->num_rows;
	}
	
	
	function repairTable($primary,$fields=array(),$secondary) {
	global $db;
		if(empty($primary) || !$fields || !$secondary) {
			return false;
		}
		
		foreach($fields as $field) {
				$fieldstring =$this->convertFieldArrayToString($field);
				
				$sql = "ALTER TABLE ".$primary." ADD COLUMN ".$fieldstring;
				$db->query($sql);
				if($field['type']=='relate') {
				
				$primarytbinfo = $this->getwhere("tableinfo","name='".$primary."'");
				$secondarytbinfo = $this->getwhere("tableinfo","name='".$secondary."'");
		
				
				$keyvalue = array();
				$keyvalue['name'] = $primary."_".$secondary."_1_1";
				$keyvalue['primarytable'] = $primarytbinfo['id'];
				$keyvalue['secondarytable'] = $secondarytbinfo['id'];
				$keyvalue['rtype'] = '1_1';	
				$this->save('relationships',$keyvalue);
				
				}
				
				
		}
		
		
		
	
	
	
	}
	
    function createRelationship($primary =false,$secondary=false,$type=false,$label=false,$secondlabel=false) {
		global $entity;
    	if(!$primary || !$secondary || !$type) {
			die("Incorrect parameters for create relationship ".$primary." ".$secondary." ".$type);
		}
		
		if($type=='1_1') {
			$fields = array();
			$fields[$secondary.'_id']['name'] = $secondary.'_id';
			$fields[$secondary.'_id']['type'] = 'relate';
			$fields[$secondary.'_id']['rmodule'] = $secondary;
			$fields[$secondary.'_id']['label'] = $secondary.' Id';
			
			$this->repairTable($primary,$fields,$secondary);
			return true;
		}
		
		$primaryinfo = $this->getwhere('tableinfo',"name='".$primary."'");
		$secondaryinfo = $this->getwhere('tableinfo',"name='".$secondary."'");
		if($primaryinfo && $secondaryinfo) {
			
			$name = strtolower($primaryinfo['name'].'_'.$secondaryinfo['name'].'_'.$type);
			
			$alias = $this->createAlias('relationships',$name);
			$fields = array();
			$primaryid = strtolower($primary.'_id');
			$secondaryid = strtolower($secondary.'_id');
			
			
			$fields[$primaryid]['name'] =  $primaryid;
			$fields[$primaryid]['type'] =  'char';
			$fields[$primaryid]['len']  =  '36';
			$fields[$primaryid]['notnull'] =  true;
			
			$fields[$secondaryid]['name'] =  $secondaryid;
			$fields[$secondaryid]['type'] =  'char';
			$fields[$secondaryid]['len']  =  '36';
			$fields[$secondaryid]['notnull'] =  true;
				
			$id = $this->createEntity($alias,array('label'=>$label,'secondlabel'=>$secondlabel,'fields'=>$fields,'rtype'=>$type,'type'=>'relationship','values'=>array($primaryinfo['id'],$secondaryinfo['id'])));
			
		} else {
			die("primary module ".$primary." not found");
		}
	}
	
	function load_relationships() {
		global $db;
	
		$sql ="select rel.*,tb.name as rtable  from relationships rel left join tableinfo tb on rel.secondarytable=tb.id  where rel.primarytable='".$this->tableinfo['id']."' and (rel.rtype='1_M' or rel.rtype='M_M') and rel.deleted=0";
		$this->relationships = $db->getrows($sql,'name');
		
		
		
	}
	
	
	function get_relationships($rtable,$index=false) {
		$table = $this->relationships[$rtable]['rtable'];
		
	
	$sql = "select ".$table.".* from $rtable  inner join ".$table." on ".$rtable.".".$table."_id = ".$table.".id where ".$rtable.".".$this->module."_id='".$this->record."' and ".$rtable.".deleted=0 order by ".$rtable.".date_modified desc";
	$rows = $this->results($table,$sql,true,false,$index);
		return $rows;
	}
	function results($tentity = false,$sql = false,$paginate=true,$url=false,$index=false) {
			global $vjlib,$current_url;
			
			$vardef = getvardef($tentity);
			$listviewdef = $vardef['metadata']['listview'];
			$this->listview['metadata'] = $listviewdef;
			
			
			
			$table = $tentity;
			$fields = array();
			
			$counter =0;
			foreach($listviewdef as $field=>$def) {
					if(isset($def['rmodule'])) {
						$fields[] = $def['rmodule'].$counter."_r.name as ".$field."_name";					
					} else {
						$fields[] = $table.".".$field;					
				}
			       $counter++;  
			}
			$paginate = $vjlib->Paginate;
			
			$paginate->module = $tentity;
			$paginate->href = $current_url;
			$paginate->extrafields = array();
				
					
			$url = "index.php?module=".$tentity."&page=";
			if(!$sql) {
				
				$sql = "SELECT ".$table.".id, ".implode(',',$fields)." FROM ".$table." ";
				
				$counter = 0;
				foreach($listviewdef as $field=>$def) {
					if(isset($def['rmodule'])) {
					    
					    if($def['type']=="nondb") {
					        $sql .= " LEFT JOIN ".$def['name']."  ON ".$table.".id =".$def['name'].".".$table."_id AND ".$def['name'].".deleted=0 ";
					        $sql .= " LEFT JOIN ".$def['rmodule']." ".$def['rmodule'].$counter."_r  ON ".$def['name'].".".$def['rmodule']."_id =".$def['rmodule'].$counter."_r.id AND ".$def['rmodule'].$counter."_r.deleted=0 ";
					    } else {
					        $sql .= " LEFT JOIN ".$def['rmodule']." ".$def['rmodule'].$counter."_r  ON ".$table.".".$field."=".$def['rmodule'].$counter."_r.id AND ".$def['rmodule'].$counter."_r.deleted=0";
					        
					    }
					    
						//$sql .= " LEFT JOIN ".$def['rmodule']." ".$def['rmodule']."_r  ON ".$table.".".$field."=".$def['rmodule']."_r.id AND ".$def['rmodule']."_r.deleted=0";
					}
					$counter++;
				}
				
				$sql .= " where ".$table.".deleted=0 order by ".$table.".date_entered DESC";
			}
			$this->defaultPaginate($sql,$tentity);
			if($index) {
			 $paginate->index = $index;
			}
			 return $paginate->process();
			
			
		}
	
	
	function defaultPaginate($sql,$tentity=false) {
			global $vjlib,$db,$vjconfig;
			
			$paginate = $vjlib->Paginate;
			$paginate->url = '';
			$paginate->index ='id';
			$paginate->noresult = 10;
			$paginate->endto = 10;
			$paginate->sql = $sql;
			$paginate->db = $db;
			
			$url = "./index.php?module=".$tentity."&action=detailview&record=key_id";
			$url = processUrl($url);
			$paginate->process['name'] = array("tag"=>"a",'value'=>'key_name','attr'=>array("href"=>$url));
	}
	
	
	
	function addRelationship($relationship,$relationshipId) {
	       global $globalRelationshipList,$globalEntityList,$db;
	       
	       if(isset($globalRelationshipList[$relationship])) {
	           
	           if($globalRelationshipList[$relationship]['rtype']=="1_M") {
	               $sql  ="delete from ".$relationship. " where ".$globalEntityList[$globalRelationshipList[$relationship]['secondarytable']]['name']."_id = '".$relationshipId."'";
	               $db->query($sql);
	           }
	           $keyvalue = array();
	           
	           
    	       $keyvalue[$globalEntityList[$globalRelationshipList[$relationship]['primarytable']]['name'].'_id'] = $this->record;
    	       $keyvalue[$globalEntityList[$globalRelationshipList[$relationship]['secondarytable']]['name'].'_id'] = $relationshipId;
    	       $this->save($relationship, $keyvalue);
    	       return true;
	       }
	       
	       return false;
	       
	       
	       
	}
	
	
	function removeRelationship($relationship,$relId) {
	    global $globalEntityList,$globalRelationshipList;
	       
	       
	       
	       
	       
	       $keyvalue = array("deleted"=>1);
	       $where =  $globalEntityList[$globalRelationshipList[$relationship]['primarytable']]['name']."_id = '".$this->record."' and ";
	       $where .= $globalEntityList[$globalRelationshipList[$relationship]['secondarytable']]['name']."_id = '".$relId."' ";    
           $this->save($relationship, $keyvalue,$where);
	       
	       
	     
	}
	
}
