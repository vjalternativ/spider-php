<?php 

require_once 'include/vjlib/abstract/AWidget.php';
class widgetViewEdit extends ViewEdit {
    
    
    function preDisplay() {
        global $db;
        
        
        parent::preDisplay();
        
        $GLOBALS['app_list_strings']['widget_type_list'] = array();
        
        $folders = scandir('include/vjlib/libs/bootstrap4/widgets/');
        
        unset($folders[0]);
        unset($folders[1]);
        
        $folders=  array_combine($folders,$folders);
        
        
        global $vjconfig;
        $sitefolder = scandir($vjconfig['basepath'].'include/entrypoints/site/widgets/'.$vjconfig['sitetpl'].'/');
        
        unset($sitefolder[0]);
        unset($sitefolder[1]);
        
        $sitefolder=  array_combine($sitefolder,$sitefolder);
        
        $folders=  array_merge($sitefolder,$folders);
        
        $folders[''] = "select";
        
        $GLOBALS['app_list_strings']['widget_type_list'] = $folders;

        
        
        $posList = array();
        $posList[''] = "select";
        
        
        
        $this->def['fields']['widget_type']['options'] = 'widget_type_list';
        $pageId = false;
        if(isset($_REQUEST['parent_record'])) {
            $pageId =$_REQUEST['parent_record'];
        } else if($this->data) {
            $widgetId = $this->data['id'];
            
            $sql = "select page_id from page_widget_m_m where deleted=0 and widget_id='".$widgetId."'";
            $pageData = $db->getrow($sql);
            
            if($pageData) {
                $pageId  = $pageData['page_id'];
            }
            
            
        }
        
        
        global $vjconfig;
        if(file_exists($vjconfig['basepath']."include/entrypoints/site/layout/".$vjconfig['sitetpl']."/".$vjconfig['sitetpl']."Positions.php")) {
            require_once $vjconfig['basepath']."include/entrypoints/site/layout/".$vjconfig['sitetpl']."/".$vjconfig['sitetpl']."Positions.php";
        }
        
        if($pageId) {
            global $entity;
            $pageData = $entity->get("page",$pageId);
            $page = $pageData['name'];
            if(file_exists($vjconfig['basepath']."include/entrypoints/site/pages/".$page."/layout/".$vjconfig['sitetpl']."/".$page."Positions.php")) {
                require_once $vjconfig['basepath']."include/entrypoints/site/pages/".$page."/layout/".$vjconfig['sitetpl']."/".$page."Positions.php";
            }
        }
        $posList = APosition::getPositions();
        $posList[''] = "select";
        
        $GLOBALS['app_list_strings']['position_list'] = $posList;
        
        
        $this->def['fields']['position']['options'] = 'position_list';
        
        
        $this->processDefForRegisteredFields();
        
        
        
    }
    
    
    function processDefForRegisteredFields() {
        
        unset($this->def['fields']['description']);
        unset($this->def['metadata']['editview'][1]);
        
        
        $json = json_decode($this->data['description'],1);
        foreach($json as $key=>$val) {
            $this->data[$key] = $val;
        }
        $wtype = $this->data['widget_type'];
        
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
            
            $x =  new  $class;
            $fields = $x->getConfigFields();
            foreach($fields as  $field) {
                $this->def['fields'][$field['name']]['name'] = $field['name'];
                $this->def['fields'][$field['name']]['type'] = $field['type'];
                $this->def['metadata']['editview'][$field['name']]['type'] = 'row';
                $this->def['metadata']['editview'][$field['name']]['fields'][0]['gridsize'] = 6;
                $this->def['metadata']['editview'][$field['name']]['fields'][0]['field'] = $field;
                
                
            }
            
        }
        
    }
    
    function display() {
        global $vjconfig;
        parent::display();
        echo '<script src="'.$vjconfig['fwbaseurl'].'modules/widget/assets/js/widget.js"></script>';
    }
}
?>