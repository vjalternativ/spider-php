<?php
require_once 'include/vjlib/abstract/AWidget.php';
class widget_attrViewEdit extends ViewEdit {
    
    function preDisplay() {
        parent::preDisplay();
        
        $widgetId = false;
        if(isset($_REQUEST['parent_record'])) {
            
            $widgetId = $_REQUEST['parent_record'];
        } else if($this->data && $this->data['widget_widget_attr_1_m']) {
            $widgetId = $this->data['widget_widget_attr_1_m'];
            
            $json = json_decode($this->data['description'],1);
            foreach($json as $key=>$val) {
                $this->data[$key] = $val;
            }
        }
        if($widgetId) {
            
            global $entity;
            
            $wdata = $entity->get("widget",$widgetId);
            if($wdata) {
                
                $wtype = $wdata['widget_type'];
                
                global $vjconfig;
                
                $file = "include/vjlib/libs/bootstrap4/widgets/".$wtype."/".$wtype."Widget.php";
                
                $isFound = false;
                if(file_exists($file)) {
                    $isFound = true;
                } else {
                    $file = $vjconfig['basepath'].'include/entrypoints/site/widgets/'.$vjconfig['sitetpl']."/".$wtype."/".$wtype."Widget.php";
                    if(file_exists($file)) {
                        $isFound = true;
                    }
                }
                
                if($isFound) {
                    require_once $file;
                    $class = $wtype."Widget";
                    
                    $this->def['fields']  =array();
                    
                    $this->def['metadata']['editview']  =array();
                    
                    $x =  new  $class;
                   // $x=new IWidget();
                    $fields = $x->getFields();
                    
                    $nameField = array("name"=>"name","type"=>"varchar");
                    $this->def['fields']['name'] = $nameField;
                    $this->def['metadata']['editview']['name']['type'] = 'row';
                    $this->def['metadata']['editview']['name']['fields'][0]['gridsize'] = 6;
                    $this->def['metadata']['editview']['name']['fields'][0]['field'] = $nameField;
                    
                    foreach($fields as  $field) {
                        $this->def['fields'][$field['name']]['name'] = $field['name'];
                        $this->def['fields'][$field['name']]['type'] = $field['type'];
                        $this->def['metadata']['editview'][$field['name']]['type'] = 'row';
                        $this->def['metadata']['editview'][$field['name']]['fields'][0]['gridsize'] = 6;
                        $this->def['metadata']['editview'][$field['name']]['fields'][0]['field'] = $field;
                        
                        
                    }
                    
                }
            }
        }
        
        
    }
    
    function display() {
        parent::display();
    }
}
?>