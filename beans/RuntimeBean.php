<?php

abstract class RuntimeBean
{

    protected $path;

    private function checkPath()
    {
        if (! $this->path) {
            throw new Exception("runtimme path is not set");
        }
    }

    protected function doWrite($data = array())
    {
        $this->checkPath();
        $data['last_run_time'] = date("Y-m-d H:i:s");
        file_put_contents($this->path, json_encode($data, JSON_PRETTY_PRINT));
    }

    protected function readJson()
    {
        $this->checkPath();

        if (file_exists($this->path)) {
            return json_decode(file_get_contents($this->path), 1);
        }
        return false;
    }

    abstract function write();

    protected function setPath($path)
    {
        $this->path = lib_config::getInstance()->get("storage_basepath") . 'runtime/' . $path;
    }
}
?>