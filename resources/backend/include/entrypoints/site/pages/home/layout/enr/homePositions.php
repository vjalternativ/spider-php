<?php 
class homePositions extends APosition {
    public function registerPositions()
    {
        $this->registerPosition("homepos1");
        $this->registerPosition("homepos2");
        
    }

    
}

$pos = new homePositions();
$pos->registerPositions();
?>

