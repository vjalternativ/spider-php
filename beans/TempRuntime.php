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
        $this->doWrite($data);
    }

    public function moveToTemp($source)
    {
        $file = substr($source, strrpos($source, "/") + 1);

        return move_uploaded_file($source, $this->tempPath . $file);
    }

    /**
     *
     * @return string
     */
    public function getTempFilePath($source)
    {
        $file = substr($source, strrpos($source, "/") + 1);
        return $this->tempPath . $file;
    }

    public function getPath()
    {
        return "tmp/temprutime";
    }
}
?>