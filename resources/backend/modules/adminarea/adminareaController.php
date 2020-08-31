<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'].'modules/user/authenticate/Authenticate.php';

class adminareaController extends VJController
{

    public $repairTables = array();
    
    function __construct() {
        $this->repairTables["tableinfo"]=1;
        $this->repairTables["relationships"]=1;
        $this->repairTables["tableinfo_relationships_1_m"]=1;
        $this->repairTables["menu"]=1;
        $this->repairTables["menu_tableinfo_1_m"]=1;
        $this->repairTables["roles"]=1;
        $this->repairTables["roles_item"]=1;
        $this->repairTables["privilege"]=1;
        $this->repairTables["roles_privilege_1_m"]=1;
        $this->repairTables["language"]=1;
        $this->repairTables["tableinfo_language_m_m"]=1;
        $this->repairTables["submenu"]=1;
        $this->repairTables["menu_submenu_1_m"]=1;
        $this->repairTables["submenu_tableinfo_1_m"]=1;
        
        
    }
    
    function action_home()
    {
        $this->view = 'home';
    }

    
    private function repairTableSchema($rows) {
        $entity = Entity::getInstance();
        $db = MysqliLib::getInstance();
        foreach ($rows as $row) {
            $desc = json_decode(base64_decode($row['description']),1);
            $sql = "select 1 from ".$row['name']." limit 1";
            $qry = $db->query($sql,true);
            if($qry) {
                if(isset($desc['fields'])) {
                    foreach($desc['fields'] as $field) {
                        if($field['type']=="nondb") {
                            continue;
                        }
                        $field['name'] = trim($field['name']);
                        $dbField = $db->getfields($row['name']);
                        if(isset($dbField[$field['name']])) {
                            continue;
                        }
                        $fieldType = $field['type'];
                        
                        $temp = array("name" => $field['name'],'type'=>$field['type']);
                        if($temp['type']=="relate" || $temp['type']=="file") {
                            $fieldType = "char";
                            $field['len'] = '36';
                            $temp['rmodule']  = $field['rmodule'];
                            
                        } else if($temp['type']=='dependent_relate') {
                            $fieldType = "char";
                            $field['len'] = '36';
                            
                            $temp['rmodule']  = $field['rmodule'];
                            $temp['dependent_relate_field'] = $field['dependent_relate_field'];
                            $temp['dependent_relate_field'] = $field['dependent_relate_field'];
                            $temp['relate_relationship'] = $field['relate_relationship'];
                            
                        } else if($temp['type']=="checkbox") {
                            $fieldType = "int";
                        } else if($temp['type']== "enum" ) {
                            $fieldType = "varchar";
                            $field['len']  = "200";
                            $temp['options'] = $field['options'];
                            
                        }else if($temp['type']== "multienum" ) {
                            $fieldType = "text";
                        }
                        
                        
                        
                        
                        
                        $sql = "ALTER TABLE ".$row['name']." ADD COLUMN ".$field['name']." ".$fieldType." ";
                        
                        if($field['len']!="") {
                            $temp['len']= $field['len'];
                            $sql .= " (".$field['len'].") ";
                        }
                        
                        if($field['notnull']=='true') {
                            $sql .= " NOT NULL ";
                            $temp['notnull'] = 1;
                        }
                        
                        if($field['default']!='') {
                            $sql .= $field['default'];
                            $temp['default'] = $field['default'];
                            
                        }
                        
                        if(!empty($field['field_index'])) {
                            $temp['field_index'] =$field['field_index'];
                        }
                        
                        echo $sql."<br />";
                        $db->query($sql);
                        
                        
                    }
                }
                
            } else {
                
                //$entity = new Entity;
                
                $desc['type']= $row['tabletype'];
                $entity->createEntity($row['name'],$desc,true);
                echo ("repair new table ".$row['name']."<br />");
                
            }
            
            
        }
    }
    
    
    
    
    private function processSchemaAndDataPatch($data) {
        $entity = Entity::getInstance();
        $rows = $data['tableinfo'];
        $this->repairTableSchema($rows);
        $this->updateDataPatch($data);
        $entity->generateCache();
    }
    
    function action_repair()
    {
        
        $this->repairFramework();
        $vjconfig = lib_config::getInstance()->getConfig();
        $data = json_decode(file_get_contents($vjconfig['basepath']."schemajson/schema.json"),1);
        $this->processSchemaAndDataPatch($data);
    }
    
    function action_generateCache() {
        global $entity;
        $entity->generateCache();
    }
    
    
    private function updateDataPatch($data) {
        
        $db = MysqliLib::getInstance();
        foreach($data as $table => $rows) {
            
            $sql = "select * from ".$table." where deleted=0";
            $tableRows = $db->fetchRows($sql,array("id"));
            $tableRowsByName = array();
            foreach($tableRows as $row) {
                if(isset($row['name'])) {
                    $tableRowsByName[$row['name']] = $row['id'];
                }
            }
            
            
            foreach($rows as $id=>$row) {
                $isNew = false;
                $sql = "UPDATE ";
                if(isset($tableRows[$id])) {
                   echo "updating table ".$table." for ID ".$id."<br />";
                } else {
                    
                    if(isset($tableRowsByName[$row['name']])) {
                        echo "updating existing table with new tableinfo ".$table." for ID ".$id."<br />";
                        
                        $sqla = "update ".$table." set id='".$id."' where id='".$tableRowsByName[$row['name']]."' ";
                        $db->query($sqla);
                        
                        
                        $row['id'] = $id;
                        
                    } else {
                        $isNew = true;
                        $sql = "INSERT INTO ";
                        //$row['new_with_id'] = true;
                        echo "inserting table ".$table." for ID ".$id."<br />";
                    }
                }
                
               $sql .= $table." SET ";
               $cols = array();
               unset($row['isfirstrow']);
                foreach($row as $key=>$val) {
                    $cols[$key] = $key."='".addslashes($val)."'"; 
                }
                $sql .= implode(",",$cols);
               if(!$isNew) {
                        $sql .= " WHERE id = '".$row['id']."'";
               }
               $db->query($sql);
                //$row['hook_skip'] = true;
                //$entity->save($table,$row);
            }
        }
        
    }
    
    function action_updateschema() {
            $db = lib_mysqli::getInstance();
	    $vjconfig = lib_config::getInstance()->getConfig();
            $data = array();
            foreach($this->repairTables as $table=>$val) {
                $sql = "select * from ".$table." where deleted=0";
                $data[$table] = $db->fetchRows($sql,array("id"));
                
            }
            file_put_contents($vjconfig['basepath']."schemajson/schema.json",json_encode($data));
    }
    
    
    function changeFieldLayout($layout,$isSeq=false) {
        $layout = array_values($layout);
        $lt = array();
        foreach($layout as $key=>$field) {
            if($isSeq) {
                $lt[$field['name']] = $field['name'];
            } else {
                if(isset($field['type'])) {
                    $lt[$key]['type'] = $field['type']; 
                } else {
                    if(isset($field['fields'])) {
                        $lt[$key]['type'] = "row";
                    } else if (isset($field['label'])) {
                        $lt[$key]['type'] = "hr";
                    }
                }
                
                if(isset($field['fields'])) {
                    foreach($field['fields'] as $field) {
                        $lt[$key]['fields'][] = array("field"=>$field['field']['name'],"gridsize" => $field['gridsize']);
                    }
                }
                if(isset($field['label'])) {
                    $lt[$key]['label'] = $field['label'];
                }
                
            }
        }
          return $lt;  
    }
    
    function action_showPatch() {
        global $globalEntityList,$vjconfig;
        
        $this->repairTables['user'] = 1;
        foreach($globalEntityList as $key=>$entity) {
            
            $name = $entity['name'];
            $desc = json_decode(base64_decode($entity['description']),1);
            
            $jsonData = array();
            $jsonData['name'] = $name;
            $jsonData['type'] = $entity['tabletype'];
            $jsonData['label'] = $entity['label'];
            $jsonData['fields'] = $desc['fields'];
            
          //  echo "<pre>";print_r($entity);die;
            $jsonData['listviewdef'] =isset($entity['listviewdef']) ? json_decode($entity['listviewdef']) : array();
            $jsonData['editviewdef'] = isset($entity['editviewdef']) ? json_decode($entity['editviewdef']) :array();
            $jsonData['detailviewdef'] = isset($entity['detailviewdef']) ? json_decode($entity['detailviewdef']) :array();
            $jsonData['searchviewdef'] = isset($entity['searchviewdef']) ? json_decode($entity['searchviewdef']) :array();
            
            if(isset($desc['metadata']['listview']) && !$jsonData['listviewdef']) {
                $jsonData['listviewdef'] = $this->changeFieldLayout($desc['metadata']['listview'],true);
            }
            if(isset($desc['metadata']['editview']) && !$jsonData['editviewdef']) {
                $jsonData['editviewdef'] = $this->changeFieldLayout($desc['metadata']['editview']);
            }
            if(isset($desc['metadata']['detailview']) && !$jsonData['detailviewdef']) {
                $jsonData['detailviewdef'] = $this->changeFieldLayout($desc['metadata']['detailview']);
            }
            if(isset($desc['metadata']['searchview']) && !$jsonData['searchviewdef']) {
                $jsonData['searchviewdef'] = $this->changeFieldLayout($desc['metadata']['searchview'],true);
            }
            
            unset($desc['metadata']);
            
            $globalEntityList[$key]['description'] = base64_encode(json_encode($desc));
            $globalEntityList[$key]['listviewdef'] = json_encode($jsonData['listviewdef']);
            $globalEntityList[$key]['editviewdef'] = json_encode($jsonData['editviewdef']);
            $globalEntityList[$key]['detailviewdef'] = json_encode($jsonData['detailviewdef']);
            $globalEntityList[$key]['searchviewdef'] = json_encode($jsonData['searchviewdef']);
            //file_put_contents("include/install/schemapatch/".$name.".json", json_encode($jsonData,JSON_PRETTY_PRINT));
         
        }
        
       // echo "<pre>";print_r($globalEntityList);die;
        
        file_put_contents("include/install/datapatch/tableinfo.json", json_encode($globalEntityList,JSON_PRETTY_PRINT));
        
        $repairTables = $this->repairTables;
        unset($repairTables["tableinfo"]);
        $db = MysqliLib::getInstance();
        foreach($repairTables as $key=>$data) {
            $sql ="select * from ".$key." where deleted=0";
            $data = $db->fetchRows($sql,array("id"));
            file_put_contents($vjconfig["fwbasepath"]."include/install/datapatch/".$key.".json", json_encode($data,JSON_PRETTY_PRINT));
        }
        
    }
    
    
    function repairFramework() {
        $vjconfig = lib_config::getInstance()->getConfig();
        $data = array();
        
        $db = MysqliLib::getInstance();
         
        $sql ="delete from tableinfo where deleted=1";
        $db->query($sql);
        foreach($this->repairTables as $tablename=>$row) {
            $row = json_decode(file_get_contents($vjconfig['fwbasepath']."include/install/datapatch/".$tablename.".json"),1);
            $data[$tablename] = $row;
        }
        $this->processSchemaAndDataPatch($data);
        
        
        $sql = "select * from tableinfo where deleted=0";
        $trows = $db->fetchRows($sql,array("id"));
        
        
        $sql = "select * from relationships where deleted=0";
        $rows = $db->fetchRows($sql,array("id"));
        $entity = Entity::getInstance();
        //echo "<pre>";print_r($rows);die;
        foreach($rows as $row) {
            if(isset($trows[$row['primarytable']]) && isset($trows[$row['secondarytable']])) {
                $row['primary_table_text'] =  $trows[$row['primarytable']]['name'];
                $row['secondary_table_text'] =  $trows[$row['secondarytable']]['name'];
                $row['primarytable'] =  $trows[$row['primarytable']]['id'];
                $row['secondarytable'] =  $trows[$row['secondarytable']]['id'];
                $entity->save("relationships",$row);
            
            } else {
                
                if($row['primary_table_text'] && $row['secondary_table_text']) {
                    
                }
                echo "relationship entity not found for ".$row['name']."<br/>";
               /*  if(isset($globalEntityList[$row['primarytable']])) {
                    die($globalEntityList[$row['primarytable']]);
                } */
            }
            
        }
        
    }
    
    function action_repairFramework() {
        $this->repairFramework();
    }
    
    function action_cleanupmodules() {
        $db = MysqliLib::getInstance();
        $sql = "select name,group_concat(t.id) ids from tableinfo t group by t.name having count(*)>1";
        $rows = $db->fetchRows($sql);
        $data = array();
        foreach($rows as $row) {
            $ids = explode(",",$row['ids']);
            $id = $ids[0];
            unset($ids[0]);
            $data[$id] = $ids;
        }
        
        foreach($data as $id=>$ids) {
            $sql ="update relationships set primarytable='".$id."' where primarytable in ('".implode("'.'",$ids)."') ";
            $db->query($sql);
            $sql ="update relationships set secondarytable='".$id."' where secondarytable in ('".implode("'.'",$ids)."') ";
            $db->query($sql);
            $sql = "delete from tableinfo where id in ('".implode("'.'",$ids)."')";
            $db->query($sql);
        }
        $sql = "select name,group_concat(id) as ids from relationships group by name having count(*) > 1";
        $rows = $db->fetchRows($sql);
        $data = array();
        foreach($rows as $row) {
            $ids = explode(",",$row['ids']);
            $id = $ids[0];
            unset($ids[0]);
            $sql = "delete from relationships where id in ('".implode("'.'",$ids)."')";
            $db->query($sql);
        }
        
        
        //select r.*,t.id from relationships r left join tableinfo t on r.secondarytable=t.id where t.id is null;
        //select name,count(*) from relationships group by name having count(*) > 1;
        //select name,group_concat(t.id) ids from tableinfo t group by t.name having count(*)>1;
        
        
    }
    
    
}