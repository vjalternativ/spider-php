<?php
require_once __DIR__ . '/RuntimeBean.php';

abstract class ModuleRuntime extends RuntimeBean
{

    private $moduleList = array();

    abstract function getPath();

    abstract function getModule();

    function init()
    {
        $date = date("Y-m-d");
        $this->setPath($this->getPath());
        $json = $this->readJson();

        if ($json) {
            if ($date == $json['lastCacheDate']) {
                $this->moduleList = $json['moduleList'];
            } else {
                $this->write();
            }
        } else {
            $this->write();
        }
    }

    public function write()
    {
        $date = date("Y-m-d");
        $db = lib_database::getInstance();

        $sql = "select * from " . $this->getModule() . " where deleted=0";
        $this->moduleList = $db->getAll($sql, array(
            "name"
        ), "name", null, false);

        if ($this->moduleList) {
            $data = array();
            $data['moduleList'] = $this->moduleList;
            $data['lastCacheDate'] = $date;
            $this->doWrite($data);
        }
    }

    public function getModuleList()
    {
        return $this->moduleList;
    }
}
?>