<?php 
class enrPositions extends APosition {
    
    static $TOP_HEADER = "topheader";
    static $SLIDER = "slider";
    static $CONTENT_TOP ='contenttop';
    static $CONTENT_BOTTOM ='contentbottom';
    
    public function registerPositions()
    {
        $this->registerPosition(self::$TOP_HEADER);
        $this->registerPosition(self::$SLIDER);
        $this->registerPosition(self::$CONTENT_TOP);
        $this->registerPosition(self::$CONTENT_BOTTOM);
        
    }

    
}

$pos = new enrPositions();
$pos->registerPositions();
?>

