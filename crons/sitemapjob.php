<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'crons/SiteMapProcessor.php';
require_once $vjconfig['fwbasepath'] . 'resources/cli/CLIService.php';

class SitemapJob
{

    use CLIService;

    public $updateval = 0;

    public $row = array();

    public function execute()
    {
        $db = lib_database::getInstance();
        $sql = "select * from sitemapjob where deleted=0";
        $rows = $db->fetchRows($sql, array(
            'id'
        ));
        foreach ($rows as $row) {
            if ($row['jobstatus'] == "pending") {
                continue;
            } else {
                if ($row['updateval'] == "1") {
                    $this->updateval = 0;
                } else {
                    $this->updateval = 1;
                }
            }
            $row['updateval'] = $this->updateval;
            $this->cleanupSiteMaps($row);
            $this->updateSiteMapJob($row);

            $processor = new SiteMapProcessor();
            $processor->execute();
        }
    }

    function updateSiteMapJob($row)
    {
        $entity = lib_entity::getInstance();
        $row['jobstatus'] = "pending";
        $row['updateval'] = $this->updateval;
        $entity->save("sitemapjob", $row);
    }

    function cleanupSiteMaps($row)
    {
        $db = lib_database::getInstance();
        $sql = "delete from sitemap where page_module='" . $row['page_module'] . "'";
        $db->query($sql);
    }
}


