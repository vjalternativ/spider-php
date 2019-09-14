<?php
require_once 'modules/user/authenticate/Authenticate.php';

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
    }
    
    function action_home()
    {
        $this->view = 'home';
    }

    function action_repair()
    {
        global $db,$entity,$vjconfig;
        $data = json_decode(file_get_contents($vjconfig['basepath']."schemajson/schema.json"),1);
        
        $rows = $data['tableinfo'];
        
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
                            $field['len']  = "255";
                            $temp['options'] = $field['options'];
                            
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
        
        $this->replaceschema($data);
        
    }
    
    
    private function replaceschema($data) {
        global $db,$entity;
        
        foreach($this->repairTables as $table=>$val) {
            
                $sql = "delete from ".$table;
                
                echo $sql."<br />";
                $db->query($sql,true);
                
            
            
            
        }
        
        foreach($data as $table => $rows) {
            
            foreach($rows as $id=>$row) {
                
                echo "insert into table ".$table." for ID ".$id."<br />";
                
                $row['new_with_id'] = true;
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
}