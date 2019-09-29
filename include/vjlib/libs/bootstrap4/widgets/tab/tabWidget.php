<?php 
class tabWidget extends AWidget {
    
    
    function __construct() {
        $this->registerField("sql", "text");
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