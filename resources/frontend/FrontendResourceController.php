<?php
$dir = __DIR__ . '/';
require_once $dir . '../widget/WidgetServiceRegistrar.php';
require_once $dir . '../../libs/lib_current_user.php';

class FrontendResourceController extends ResourceController
{

    private $page;

    protected $siteBasePath;

    protected $sitetpl;

    private $backendPageModel = null;

    function __construct()
    {
        parent::__construct();
        $vjconfig = lib_config::getInstance()->getConfig();

        $this->sitebasePath = $vjconfig['basepath'] . 'resources/' . $_GET['resource'] . '/modules/';

        $this->page = $_GET['module'];
        $this->params['sitetpl'] = $vjconfig['sitetpl'];

        $seoParams = lib_seo::getInstance()->getParams();

        $db = lib_database::getInstance();

        $controller = $this->sitebasePath . $this->page . '/' . $this->page . ucfirst($_GET['resource']) . 'Controller.php';

        if (! array_key_exists("disabledb", $vjconfig) || ! $vjconfig['disabledb']) {
            if (file_exists($controller) || file_exists($this->sitebasePath . '/pages/' . $this->page . '/controller.php')) {
                if ($this->page == "page") {
                    if (isset($seoParams[0]) && $seoParams[0]) {
                        $sql = "select * from page where alias='" . $seoParams[0] . "' and deleted=0";
                        if (isset($seoParams[1]) && $seoParams[0] == "page") {
                            $sql = "select * from page where alias='" . $seoParams[1] . "' and deleted=0";
                        }
                        $row = $db->getrow($sql);
                        if ($row) {
                            lib_datawrapper::getInstance()->set("pagedata", $row);
                            $this->page = "page";
                        }
                    } else {
                        $sql = "select * from page where alias='home' and deleted=0";
                        $row = $db->getrow($sql);
                        if ($row) {
                            lib_datawrapper::getInstance()->set("pagedata", $row);
                            $this->page = "page";
                        }
                    }
                } else {
                    $sql = "select * from page where alias='" . $this->page . "' and deleted=0 ";
                    $row = $db->getrow($sql);
                    if ($row) {
                        lib_datawrapper::getInstance()->set("pagedata", $row);
                    }
                    if ($this->backendPageModel) {
                        $sql = "select * from " . $this->backendPageModel . " where alias='" . $seoParams[1] . "' and deleted=0 ";
                        $row = $db->getrow($sql);
                        if ($row) {
                            lib_datawrapper::getInstance()->set("pagedata", $row);
                        }
                    }
                }

                $pageData = lib_datawrapper::getInstance()->get("pagedata");

                if ($pageData) {
                    $this->params['meta_key'] = $pageData['meta_key'];
                    $this->params['meta_desc'] = $pageData['meta_desc'];
                    $this->params['meta_title'] = $pageData['meta_title'];

                    $this->params['pagedata'] = $pageData;

                    $baseurl = $vjconfig['baseurl'];

                    if (! $seoParams) {
                        $baseurl = rtrim($baseurl, "/");
                    }

                    $this->params['canonical_url'] = $baseurl . implode("/", $seoParams);
                }
            } else {

                die("404 page not found");
            }
        }
    }

    function getBreadcrumb()
    {
        return lib_datawrapper::getInstance()->get("breadcrumb");
    }

    function registerBreadcrumb($title, $items = array())
    {
        $dataWrapper = lib_datawrapper::getInstance();
        $breadcrumb = $dataWrapper->get("breadcrumb");
        if (! $breadcrumb) {
            $breadcrumb = array();
        }
        $breadcrumb['title'] = $title;
        foreach ($items as $id => $item) {

            $breadcrumb['items'][$id]['name'] = $item['name'];
            $breadcrumb['items'][$id]['link'] = $item['link'];
        }
        $dataWrapper->set("breadcrumb", $breadcrumb);
        lib_smarty::getSmartyInstance()->assign("breadcrumb", $breadcrumb);
    }

    protected function setBackendPageModule($module)
    {
        $this->backendPageModel = $module;
    }
}
?>