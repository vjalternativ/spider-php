<?php 

require_once $vjconfig['fwbasepath'].'include/vjlib/abstract/AWidget.php';
require_once $vjconfig['fwbasepath'].'include/vjlib/libs/bootstrap4/bootstrap4.php';
require_once $vjconfig['fwbasepath'].'include/vjlib/libs/bootstrap4/IBootstrapWidgetConstant.php';

class cardrowWidget extends AWidget {
    

    
    
    
    private $rows = 0;
    private $cards = 0;
    private $rowindex = 0;
    private $cardindex  = 0;
    private $checkMaxRows = false;
    private $title ="";
    private $data = array();
    private $maxrows = 10;
    private $maxcards = 3;
    private $isSetSize = false;
    
    public function processWidgetParams($params)
    {
        if(is_array($params)) {
            if(isset($params['items'])) {
                if(isset($params['maxcards'])) {
                    $this->maxcards= $params['maxcards'];
                }
                if(isset($params['isSetSize'])) {
                    $this->isSetSize = $params['isSetSize']; 
                }
                
                
                foreach($params['items'] as $item) {
                    $this->addcard($item);
                }
                $params = array();
                $params['title'] = $this->title;
                $params['data'] = $this->data;
                 
            }
       }
       
        return $params;
    }
    function __construct($title="",$maxrow=10,$maxcards=3) {
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
                if($this->isSetSize)  {
                    $this->data[$this->rowindex][$this->cardindex]['size'] = 12/$this->maxcards;
                }
                $this->data[$this->rowindex][$this->cardindex]['content'] = $card;
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