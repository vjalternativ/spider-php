<?php 

class Bootstrap4  {
    
    
    static function getCssJs($bootstrap=4.3,$jquery=3.4) {
        
        global $vjconfig;
        $link ='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/css/'.$bootstrap.'/bootstrap.min.css" />';
        $link .='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/css/util.css" />';
        $link .='<script src="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/js/jquery/'.$jquery.'/jquery.min.js"></script>';
        $link .='<script src="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/assets/js/'.$bootstrap.'/bootstrap.min.js" ></script>';
        return $link;
               
    }
    
    
    static function loadWidgetAtPositionByPage($pos) {
        global $seoParams,$db;
        
        
        $pageData = $seoParams['pagedata'];
        if($pageData) {
            $id = $pageData['id'];
            
            $sql = "select w.* from widget w inner join page_widget_m_m pw on w.id=pw.widget_id and pw.deleted=0 and w.deleted=0 and w.position='".$pos."' and pw.page_id='".$id."' and w.status='Active' ";
            $widgets = $db->fetchRows($sql);
            $html = "";
            foreach($widgets as $widget) {
                $html .= self::rendorWidget($widget);    
            }
            return $html;
        }
    }
    
    
    static function rendorWidget($row) {
        global $vjconfig;
        require_once $vjconfig['fwbasepath'].'include/vjlib/abstract/AWidget.php';
        
        global $db;
        $sql = "select wa.* from widget_widget_attr_1_m wwa inner join widget_attr wa on wwa.widget_attr_id=wa.id and wa.deleted=0 and wwa.deleted=0 and wwa.widget_id='".$row['id']."' ";
        $rows = $db->fetchRows($sql,array("id"));
        
        $params = array();
        
        $checkFirst = true;
        foreach($rows as $id => $data) {
            
            $params[$id]["isfirst"] = false;
            
            if($checkFirst) {
                $params[$id]["isfirst"] = true;
                $checkFirst =false;
            }
            $params[$id]["name"]  = $data['name'];
            $params[$id]['attrs'] = json_decode($data['description'],1);
            $params[$id] = AWidget::processParams($row['widget_type'],$params[$id]);
            
        }
        
        return self::loadWidget($row['widget_type'],$params);
        
        //AWidget::rendorWidget($row['widget_type'],$rows);
    }
    
    static function loadWidgetAtPosition($pos) {
        
        global $db;
        $sql = "select * from widget where deleted=0 and status='Active' and position = '".$pos."' ";
        $rows = $db->fetchRows($sql);
        $html = '';
        foreach($rows as $row) {
           $html .= self::rendorWidget($row);
        }
        return $html;
        
     }
     static function loadWidget($widgetName = "div",$params=array()) {
        
        global $smarty,$vjconfig;
        
        $dir = __DIR__;
        $smarty->assign("params",$params);
        
        if(file_exists($dir."/widgets/".$widgetName."/".$widgetName."Widget.tpl")) {
            
            $html = $smarty->fetch($dir."/widgets/".$widgetName."/".$widgetName."Widget.tpl");
            if(file_exists($dir."/widgets/".$widgetName."/".$widgetName."Widget.css")) {
                $link ='<link rel="stylesheet" href="'.$vjconfig['fwbaseurl'].'include/vjlib/libs/bootstrap4/widgets/'.$widgetName.'/'.$widgetName.'Widget.css" />';
                $html = $link.$html;   
            } 
        } else {
            die("widget not found at ".$dir."/widgets/".$widgetName."/".$widgetName."Widget.tpl");
            
        }
        return $html;
    }
    
}

?>