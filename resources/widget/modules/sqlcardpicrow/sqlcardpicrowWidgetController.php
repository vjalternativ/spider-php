<?php 
class sqlcardpicrowWidgetController extends WidgetResourceController {
    function __construct() {
        $this->registerField("maxrows","int");
        $this->registerField("maxcardsperrow","int");
        $this->registerField("sql","text");
        $this->registerField("imagefield","varchar");
        $this->registerField("titlefield","varchar");
        $this->registerField("linkfield","varchar");
        $this->registerField("linkprefix","varchar");
        $this->registerField("seoparam","int");
        
    }
    public  function processWidgetParams($params)
    {
        
        
        $db = lib_mysqli::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();
        $seoParams = lib_seo::getInstance()->getParams();
        $sql = $params['attrs']['sql'];
        if(!$params['attrs']['sql']) {
            echo "<pre>";print_r($params);die;
        }
        
        if(isset($params['attrs']['seoparam']) && isset($seoParams[$params['attrs']['seoparam']]) && isset($seoParams['widget']['alias'][$seoParams[$params['attrs']['seoparam']]])) {
                $sql = str_replace("@seoparam_id", $seoParams['widget']['alias'][$seoParams[$params['attrs']['seoparam']]], $sql);
            }
        
        $rows = $db->fetchRows($sql);
        
        require_once $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/cardrow/cardrowWidget.php";
        
        $cardWidget = new cardrowWidget($params['name'],$params['attrs']['maxrows'],$params['attrs']['maxcardsperrow']);
        
        if(isset($seoParams[1])) {
            $params['attrs']['linkprefix'] =  str_replace("@seoparam_alias_1", $seoParams[1], $params['attrs']['linkprefix']);
        }
        foreach($rows as $row) {
            $param = array();
            
            foreach($row as $key=>$val) {
                $params['attrs']['linkprefix'] = str_replace("@".$key, $val, $params['attrs']['linkprefix']);
                
                
            }
            if(!isset($row[$params['attrs']['imagefield']])) {
                //echo "<pre>";print_r($row);die;
            }
            $param['body'] = '<img class="img-thumbnail" alt="'.$row['name'].'" src="'.$vjconfig['fwurlbasepath'].'index.php?module=media_files&action=download&id='.$row[$params['attrs']['imagefield']].'" />';
            $param['footer'] ='<a href="'.$vjconfig['baseurl'].$params['attrs']['linkprefix'].$row[$params['attrs']['linkfield']].'"> '. $row[$params['attrs']['titlefield']].'</a>';
            $cardWidget->addcard($param);
           
        }
        $params['widget'] = $cardWidget->getWidget();
        
        return $params;
        
    }

}
?>