<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'resources/cli/modules/sitemap/SiteMapProcessor.php';

class sitemapCliController extends CliResourceController
{

    public $updateval = 0;

    public $row = array();

    function action_generate()
    {
        $db = lib_database::getInstance();
        $sql = "select * from sitemapjob where deleted=0 and jobstatus not in ('pending','inprogress')";
        $rows = $db->fetchRows($sql, array(
            'id'
        ));
        foreach ($rows as $row) {

            if ($row['updateval'] == "0") {
                $this->updateval = 1;
            }

            $config = lib_config::getInstance()->getConfig();

            $targetPath = $config['storage_basepath'] . 'sitemaps/' . $row['page_module'];
            $path = $targetPath . '_tmp/';
            $sitemapbasepath = $config['baseurl'] . 'sitemaps/' . $row['page_module'] . '/';

            $this->preCleanupSiteMaps($row);

            $entity = lib_entity::getInstance();
            $row['jobstatus'] = "pending";
            $entity->save("sitemapjob", $row);

            $processor = new SiteMapProcessor($row, $this->updateval, $path, $sitemapbasepath);
            $processor->execute();

            $row['offsetval'] = 0;
            $row['jobstatus'] = "completed";
            $row['updateval'] = $this->updateval;
            $entity->save("sitemapjob", $row);

            $this->postCleanupSiteMap($targetPath, $path);
        }
    }

    function preCleanupSiteMaps($row)
    {
        $db = lib_database::getInstance();
        $sql = "delete from sitemap where page_module='" . $row['page_module'] . "'";
        $db->query($sql);
    }

    function postCleanupSiteMap($targetPath, $path)
    {
        $cmd = 'rm -rf ' . $targetPath;
        shell_exec($cmd);
        $cmd = 'mv ' . $path . ' ' . $targetPath;
        shell_exec($cmd);
    }
}


