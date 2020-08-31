<?php 
class DataWrapper {
    
    
    private $data = array();
    private static $instance = null;
    
    public static function getInstance() {
        if(self::$instance==null) {
            self::$instance = new DataWrapper();
        }
        return self::$instance;
    }
    
    
   public function set($key,$value) {
        $this->data[$key] = $value;
    }
    
    public function get($key) {
        
        return isset($this->data[$key]) ? $this->data[$key] : false;
    }
    
    public function getAll() {
        return $this->data;
    }
    
    
    
}
?>