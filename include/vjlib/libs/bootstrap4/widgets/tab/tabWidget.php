<?php 
class tabWidget extends AWidget {
    
    var $checkFirst = true;
    var $id = false;
    
    
    function __construct($id = false) {
        if($id) {
            $this->params['id'] = $id;
        }
        $this->registerField("sql", "text");
    }
    
    function addTab($params=array()) {
        
        
        if($this->checkFirst) {
            $params['isfirst'] = true;
            $this->checkFirst = false;
        } 
        $this->params['tabs'][]= $params;
        
        
        
    }
    
    function getWidget() {
        
        return parent::rendorWidget("tab", $this->params);
    }
    
    public function processWidgetParams($params)
    {
        
        if(isset($params['attrs']['sql'])) {
            global $db;
            $sql = $params['attrs']['sql'];
            
            $params['tabs'] = $db->fetchRows($sql,array(   array( "key" => $params['attrs']['primary_id'],"cols"=> array($params['attrs']["tabheader_name_field"])),$params['attrs']['secondary_id']));
            //$params['tabs'] = $db->fetchRows($sql,array(    $params['attrs']['primary_id'],$params['attrs']['secondary_id']));
            //echo "<pre>";print_r($params['tabs']);die;
            $checkFirst = true;
            foreach($params['tabs'] as $key=>$val) {
                if($checkFirst) {
                    $val['isfirst'] = true;
                    $checkFirst = false;
                }
                $val['name']  = $val[$params['attrs']["tabheader_name_field"]];
                $params['tabs'][$key] = $val;
            }
            
            
        }
        
        return $params;
        
        
    }

    
}
?>