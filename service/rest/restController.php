<?php 
class restController {
    
    public $module;
    public $action;
    function execute() {
        global $vjconfig;
        if(isset($_REQUEST['module']) && isset($_REQUEST['action'])) {
            $this->module = $_REQUEST['module'];
            $this->action = $_REQUEST['action'];
            $dir = __DIR__.'/';
            
            
            //set_include_path($vjconfig['fwbasepath']);
            
            
            
            $params = isset($_REQUEST['params']) ? $_REQUEST['params'] : '[]';
            $encodeType = 'json';
            if(isset($_REQUEST['encoding'])) {
                $encodeType = $_REQUEST['encoding'];
            }
            
            $data = array();
            if($encodeType == "base64") {
                   $data = json_decode(base64_decode($params),1);
            } else {
                $data = json_decode($params,1);
            }
            
            require_once $vjconfig['fwbasepath'].'service/rest/api/ARest.php';
            
            $path = $dir.'api/'.$this->module.'/'.$this->module.'Rest.php';
            if(!file_exists($path)) {
                $path = $vjconfig['basepath']."service/rest/api/".$this->module.'/'.$this->module.'Rest.php';
                if(!file_exists($path)) {
                    die("404 not found");
                }
            }
            require $path;
            $class = $this->module.'Rest';
            $method = 'action_'.$this->action;
            $ob = new $class;
            $ob->$method($data);
        }
        
        
        
    }
    
}
?>