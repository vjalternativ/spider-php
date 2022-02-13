<?php

class FrontendResourceView extends ResourceView
{

    function __construct()
    {
        parent::__construct();
    }

    private $backendPageModule;

    function loadHeader()
    {}

    /**
     *
     * @return mixed
     */
    public function getBackendPageModule()
    {
        return $this->backendPageModule;
    }

    /**
     *
     * @param mixed $backendPageModule
     */
    public function setBackendPageModule($backendPageModule)
    {
        $this->backendPageModule = $backendPageModule;
        if ($this->backendPageModule) {
            $sql = "select * from " . $this->backendPageModule . " where alias='" . lib_seo::getInstance()->get(1) . "' and deleted=0 ";
            $row = lib_database::getInstance()->getrow($sql);
            if ($row) {
                lib_datawrapper::getInstance()->set("pagedata", $row);
                $this->params['meta_title'] = $row['meta_title'];
                $this->params['meta_desc'] = $row['meta_desc'];
                $this->params['meta_key'] = $row['meta_key'];
            }
        }
    }

    function loadFooter()
    {}

    public function display()
    {}
}

