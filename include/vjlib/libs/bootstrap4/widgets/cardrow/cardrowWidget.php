<?php 

class cardrowWidget extends AWidget {
    public function processWidgetParams($params)
    {
        
        return $params;
    }

    
    
    
    private $rows = 0;
    private $cards = 0;
    
    private $rowindex = 0;
    
    private $cardindex  = 0;
    
    private $checkMaxRows = false;
    
    
    private $title ="";
    
    private $data = array();
    
    
    function cardrowWidget($title="",$maxrow=1,$maxcards=0) {
        $this->title=$title;
        $this->maxrows = $maxrow;
        $this->maxcards = $maxcards;
        $this->checkMaxRows = $maxrow;
    }
    
  
    
    
    function addcard($param=array("header"=>false,"body"=>true,"footer"=>true)) {
        $card = Bootstrap4::loadWidget(IBootstrapWidgetConstant::$CARD,$param);
        
        
        if(!$this->checkMaxRows) {
            $this->maxrows = $this->rowindex+1; 
        }
        if($this->rowindex < $this->maxrows) {
            if($this->cardindex <  $this->maxcards) {
                $this->data[$this->rowindex][$this->cardindex] = $card;
                $this->cardindex++;
            }
            if($this->cardindex == $this->maxcards) {
                $this->rowindex++;
                $this->cardindex  = 0;
            }
        }
        
    }
    
    function getWidget() {
        $param = array();
        $param['title'] = $this->title;
        $param['data'] = $this->data;
        return Bootstrap4::loadWidget(IBootstrapWidgetConstant::$CARDROW,$param);
    }
    
    
}
?>