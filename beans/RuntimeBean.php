<?php

abstract class RuntimeBean
{

    protected $path;

    protected $data = array();

    private function checkPath()
    {
        if (! $this->path) {
            throw new Exception("runtimme path is not set");
        }

        $dir = substr($this->path, 0, strrpos($this->path, "/"));
        if (! is_dir($dir)) {
            shell_exec("mkdir -p " . $dir);
        }
    }

    private function doWrite($data = array())
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

    public function write()
    {
        $this->doWrite($this->data);
    }

    protected function setPath($path)
    {
        $this->path = lib_config::getInstance()->get("storage_basepath") . 'runtime/' . $path . ".json";
    }

    abstract function getPath();

    public function load()
    {
        $this->setPath($this->getPath());
        $data = $this->readJson();
        $this->data = $data ? $data : array();
        return $this->data;
    }
}
?>