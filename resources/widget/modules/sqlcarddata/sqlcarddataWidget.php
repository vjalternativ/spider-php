<?php 
class sqlcarddataWidget extends AWidget {
    function __construct() {
        $this->registerField("sql","text");
        $this->registerField("seoparam","int");
        $this->registerField("headerfield","varchar");
        $this->registerField("bodyfield","varchar");
        $this->registerField("headerclass","varchar");
        
    }
    public  function processWidgetParams($params)
    {
        
        
        global $db,$vjconfig,$seoParams;
        $sql = $params['attrs']['sql'];
       
        if(isset($seoParams[$params['attrs']['seoparam']])) {
            
            $sql = str_replace("@seoparam",$seoParams[$params['attrs']['seoparam']],$sql);
           
        }
        $rows = $db->fetchRows($sql);
        
      
        require_once $vjconfig['fwbasepath']."include/vjlib/libs/bootstrap4/widgets/cardrow/cardrowWidget.php";
        foreach($rows as  $row) {
            
            if(isset($seoParams[$params['attrs']['seoparam']]) && isset($row['id'])) {
                if(isset($row['alias'])) {
                    $seoParams['widget']['alias'][$seoParams[$params['attrs']['seoparam']]] = $row['id'];
                }
            }
            $params['header'] = $row[$params['attrs']['headerfield']];
            $params['body'] = $row[$params['attrs']['bodyfield']];
            $params['footer'] = false;
            
            $params['headerclass'] = $params['attrs']['headerclass'];
            
            $params['card'] = Bootstrap4::loadWidget("card",$params);
        }
        
        return $params;
        
    }

}
?>