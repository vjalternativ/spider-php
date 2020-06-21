<?php
global $vjconfig;
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
        global $vjconfig;
        $data = json_decode(file_get_contents($vjconfig['basepath']."schemajson/schema.json"),1);
        $this->processSchemaAndDataPatch($data);
    }
    
    function action_generateCache() {
        global $entity;
        $entity->generateCache();
    }
    
    
    private function updateDataPatch($data) {
        
        $db = MysqliLib::getInstance();
        $entity = Entity::getInstance();
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
                if(isset($tableRows[$id])) {
                   echo "updating table ".$table." for ID ".$id."<br />";
                } else {
                    
                    if(isset($tableRowsByName[$row['name']])) {
                        echo "updating existing table with new tableinfo ".$table." for ID ".$id."<br />";
                        
                        $sql = "update ".$table." set id='".$id."' where id='".$tableRowsByName[$row['name']]."' ";
                        $db->query($sql);
                        
                        
                        $row['id'] = $id;
                        
                    } else {
                        $row['new_with_id'] = true;
                        echo "inserting table ".$table." for ID ".$id."<br />";
                    }
                }
                $row['hook_skip'] = true;
                $entity->save($table,$row);
            }
        }
        
    }
    
    function action_updateschema() {
            global $db,$vjconfig;
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
            
            $jsonData['listviewdef'] = array();
            $jsonData['editviewdef'] = array();
            $jsonData['detailviewdef'] = array();
            $jsonData['searchviewdef'] = array();
            
            if(isset($desc['metadata']['listview'])) {
                $jsonData['listviewdef'] = $this->changeFieldLayout($desc['metadata']['listview'],true);
            }
            if(isset($desc['metadata']['editview'])) {
                $jsonData['editviewdef'] = $this->changeFieldLayout($desc['metadata']['editview']);
            }
            if(isset($desc['metadata']['detailview'])) {
                $jsonData['detailviewdef'] = $this->changeFieldLayout($desc['metadata']['detailview']);
            }
            if(isset($desc['metadata']['searchview'])) {
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
        global $vjconfig;
        $data = array();
        foreach($this->repairTables as $tablename=>$row) {
            $row = json_decode(file_get_contents($vjconfig['fwbasepath']."include/install/datapatch/".$tablename.".json"),1);
            $data[$tablename] = $row;
        }
        $this->processSchemaAndDataPatch($data);
    }
}