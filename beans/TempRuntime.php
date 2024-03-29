<?php
require_once __DIR__ . '/RuntimeBean.php';

class TempRuntime extends RuntimeBean
{

    private $lastCreationDate;

    private $tempPath;

    function __construct()
    {
        $json = $this->load();

        $this->tempPath = lib_config::getInstance()->get("storage_basepath") . 'tmp/files/';

        if (! is_dir($this->tempPath)) {
            shell_exec("mkdir -p " . $this->tempPath);
        }
        $this->lastCreationDate = date("Y-m-d");

        if (! ($json && $this->lastCreationDate == $json['lastCreationDate'])) {
            $cmd = 'rm -rf ' . $this->tempPath . '*';
            shell_exec($cmd);
            $this->write();
        }
    }

    public function write()
    {
        $data = array();
        $data['lastCreationDate'] = $this->lastCreationDate;
        $this->data = $data;
        parent::write();
    }

    public function moveToTemp($source)
    {
        $file = substr($source, strrpos($source, "/") + 1);

        return move_uploaded_file($source, $this->tempPath . $file);
    }

    public function writeToTemp($name, $data)
    {
        $file = $name;

        return file_put_contents($this->tempPath . $file, $data);
    }

    /**
     *
     * @return string
     */
    public function getTempFilePath($source)
    {
        $file = substr($source, 0, 1) == "/" ? substr($source, strrpos($source, "/") + 1) : $source;
        return $this->tempPath . $file;
    }

    public function getPath()
    {
        return "tmp/temprutime";
    }
}
?>