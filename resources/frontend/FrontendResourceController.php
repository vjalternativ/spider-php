<?php
$dir = __DIR__.'/';
require_once $dir.'../widget/WidgetServiceRegistrar.php';
class FrontendResourceController   {


    private $page;
    protected $siteBasePath;

    protected $sitetpl;


    function __construct() {

        $vjconfig = lib_config::getInstance()->getConfig();

        $this->sitebasePath = $vjconfig['basepath'] . 'include/entrypoints/site/';

        $this->page = $_GET['module'];
        $this->params['sitetpl'] =  $vjconfig['sitetpl'];


        $seoParams = lib_seo::getInstance()->getParams();

        $db = lib_mysqli::getInstance();
        if (file_exists($this->sitebasePath . '/pages/' . $this->page . '/' . $this->page . 'Controller.php') || file_exists($this->sitebasePath . '/pages/' . $this->page . '/controller.php')) {
            if ($this->page == "page") {
                if (isset($seoParams[0]) && $seoParams[0]) {
                    $sql = "select * from page where alias='" . $seoParams[0] . "' and deleted=0";
                    if(isset($seoParams[1]) && $seoParams[0]=="page") {
                        $sql = "select * from page where alias='" . $seoParams[1] . "' and deleted=0";
                    }
                    $row = $db->getrow($sql);
                    if ($row) {
                        DataWrapper::getInstance()->set("pagedata", $row);
                        $this->page = "page";
                    }
                }
            } else {
                $sql = "select * from page where alias='" . $this->page . "' and deleted=0 ";
                $row = $db->getrow($sql);
                if($row) {
                    lib_datawrapper::getInstance()->set("pagedata", $row);
                }

            }

            $pageData = lib_datawrapper::getInstance()->get("pagedata");
            if($pageData) {
                $this->params['meta_key']=$pageData['meta_key'];
                $this->params['meta_des']=$pageData['meta_desc'];
                $this->params['meta_title']=$pageData['meta_title'];
            }
        } else {

            die("404 page not found");
        }

    }

}
?>