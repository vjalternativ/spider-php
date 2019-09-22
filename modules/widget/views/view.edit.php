<?php 

class widgetViewEdit extends ViewEdit {
    
    
    function preDisplay() {
        global $db;
        parent::preDisplay();
        
        $GLOBALS['app_list_strings']['widget_type_list'] = array();
        
        $folders = scandir('include/vjlib/libs/bootstrap4/widgets/');
        
        unset($folders[0]);
        unset($folders[1]);
        
        $folders=  array_combine($folders,$folders);
        
        
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
        
        
    }
    
    function display() {
        global $vjconfig;
        parent::display();
        echo '<script src="'.$vjconfig['fwbaseurl'].'modules/widget/assets/js/widget.js"></script>';
    }
}
?>