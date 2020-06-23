<?php 
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/interface/CronJob.php';

class SitemapJob implements  CronJob   {
    
    public $updateval = 0;
    public $row = array();
    public function execute()
    {
        global  $db;
        
        $sql = "select * from sitemapjob where deleted=0 and jobstatus != 'completed'";
        $row = $db->getRow($sql);
        if($row) {
            
            if($row['jobstatus'] == "pending") {
             return;   
            } else {
               
                if($row['updateval']=="1") {
                    $this->updateval = 0;
                } else {
                    $this->updateval =1;
                }
                
            }
            $this->row = $row;
            $this->cleanupSiteMaps();
            
            $this->updateSiteMapJob();
            
        }   
       
        
        
    }
    
    function updateSiteMapJob() {
        global $entity;
        $row = $this->row;
        $row['jobstatus'] = "pending";
        $row['updateval'] = $this->updateval;
        $entity->save("sitemapjob",$row);  
    }
    
    function cleanupSiteMaps() {
        global $db;
        $row = $this->row;
        $sql= "delete from sitemap where page_module='".$row['page_module']."'";
        $db->query($sql);
    }

    
}


