<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'resources/cli/modules/sitemap/SiteMapProcessor.php';

class sitemapCliController extends CliResourceController
{

    function action_generate()
    {
        $db = lib_database::getInstance();
        $sql = "select * from sitemapjob where deleted=0 and jobstatus in ('queued','completed','inprogress')";
        $rows = $db->getAll($sql, array(
            'jobstatus',
            'id'
        ));

        $entity = lib_entity::getInstance();

        if (isset($rows['completed'])) {
            foreach ($rows['completed'] as $row) {

                $row['jobstatus'] = "queued";
                $entity->save("sitemapjob", $row);
            }
        }
        $row = array();
        $runTime = new SitemapJobRuntime();
        $runTime->load();

        if (isset($rows['inprogress'])) {
            $row = reset($rows['inprogress']);
        } else if (isset($rows['queued'])) {
            $row = reset($rows['queued']);
            $row['token'] = uniqid();

            $this->preCleanupSiteMaps($row, $runTime);
        } else if (isset($rows['completed'])) {
            $row = reset($rows['completed']);
            $row['token'] = uniqid();
            $this->preCleanupSiteMaps($row, $runTime);
        }

        if ($row) {

            $row['jobstatus'] = "inprogress";
            $entity->save("sitemapjob", $row);

            $db = lib_database::getInstance();
            $config = lib_config::getInstance()->getConfig();
            $targetPath = $config['storage_basepath'] . 'sitemaps/' . $row['page_module'];
            $path = $targetPath . '_tmp/';

            if (! is_dir($path)) {
                $cmd = "mkdir -p " . $path;
                shell_exec($cmd);
            }

            $sitemapbaseurl = $config['baseurl'] . 'sitemaps/' . $row['page_module'] . '/';

            $processor = new SiteMapProcessor($row, $path, $sitemapbaseurl);
            $processor->execute();

            $this->postCleanupSiteMap($targetPath, $path);

            $row['jobstatus'] = "completed";
            $entity->save("sitemapjob", $row);
        }
    }

    function preCleanupSiteMaps($row, SitemapJobRuntime $runtime)
    {
        $runtime->setCountForId($row['id'], 0);
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

    function action_fix()
    {
        $sql = "select * from tableinfo where deleted=0 and tabletype='page'";
        $rows = lib_database::getInstance()->getAll($sql);

        foreach ($rows as $row) {

            $desc = json_decode(base64_decode($row["description"]), true);

            if (isset($desc['fields']['sitemap'])) {
                $desc['fields']['sitemap']['type'] = 'varchar';
                $desc['fields']['sitemap']['len'] = 255;

                $row['description'] = base64_encode(json_encode($desc));
                lib_database::getInstance()->update("tableinfo", $row, "id");
                $sql = "ALTER table " . $row['name'] . " modify column sitemap varchar(255) default NULL";
                lib_database::getInstance()->query($sql);
            }
        }
    }
}

