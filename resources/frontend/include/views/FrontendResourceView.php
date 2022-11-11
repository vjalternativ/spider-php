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
    public function setBackendPageModule($backendPageModule, $alias = false, $row = false)
    {
        $this->backendPageModule = $backendPageModule;
        if ($this->backendPageModule) {
            $alias = $alias ? $alias : lib_seo::getInstance()->get(1);

            $sql = "select * from " . $this->backendPageModule . " where alias='" . $alias . "' and deleted=0 ";
            $row = $row ? $row : lib_database::getInstance()->getrow($sql);
            if ($row) {
                lib_datawrapper::getInstance()->set("pagedata", $row);
                $this->params['meta_title'] = $row['meta_title'];
                $this->params['meta_desc'] = $row['meta_desc'];
                $this->params['meta_key'] = $row['meta_key'];
                $baseurl = lib_config::getInstance()->get('baseurl');

                $seoParams = lib_seo::getInstance()->getParams();
                if (! $seoParams) {
                    $baseurl = rtrim($baseurl, "/");
                }

                $this->params['canonical_url'] = $baseurl . implode("/", $seoParams);
            }
        }
    }

    function loadFooter()
    {}

    public function display()
    {}
}

