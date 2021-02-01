<?php
abstract class RuntimeBean {


    protected $path;

    protected function doWrite($data=array()) {
        $data['last_run_time']  = date("Y-m-d H:i:s");
        file_put_contents($this->path, json_encode($data,JSON_PRETTY_PRINT));
    }

    protected function readJson() {
        if(file_exists($this->path))   {
            return json_decode(file_get_contents($this->path),1);
        }
        return false;
    }

    abstract function write();


}
?>