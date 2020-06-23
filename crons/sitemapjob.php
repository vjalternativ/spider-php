<?php 
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/interface/CronJob.php';

class SitemapJob implements  CronJob   {
    
    public $updateval = 0;
    public $row = array();
    public function execute()
    {
        global  $db;
        $sql = "select * from sitemapjob where deleted=0";
        $rows = $db->fetchRows($sql,array('id'));
        foreach($rows as $row) {
            if($row['jobstatus'] == "pending") {
             continue;   
            } else {
                if($row['updateval']=="1") {
                    $this->updateval = 0;
                } else {
                    $this->updateval =1;
                }
            }
            $row['updateval'] = $this->updateval;
            $this->cleanupSiteMaps($row);
            $this->updateSiteMapJob($row);
         }
        
    }
    
    function updateSiteMapJob($row) {
        global $entity;
        $row['jobstatus'] = "pending";
        $row['updateval'] = $this->updateval;
        $entity->save("sitemapjob",$row);  
    }
    
    function cleanupSiteMaps($row) {
        global $db;
        $sql= "delete from sitemap where page_module='".$row['page_module']."'";
        $db->query($sql);
    }

    
}


