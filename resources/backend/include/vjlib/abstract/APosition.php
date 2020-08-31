<?php 
abstract class APosition {
    private static $positions =array();
    
    abstract function registerPositions();
    
    
    function registerPosition($pos) {
        self::$positions[$pos] = $pos;
    }
    static function getPositions() {
        return self::$positions;
    }
    
    
}
?>