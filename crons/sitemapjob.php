<?php 
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/interface/CronJob.php';

class page_componentSitemapJob implements  CronJob   {
    
    public $updateval = 0;
    public function execute()
    {
        global  $db;
        
        $sql = "select * from sitemapjob where deleted=0 ";
        $row = $db->getRow($sql);
        if($row) {
            
            if($row['jobstatus'] == "pending") {
             return;   
            } else {
               
                if($row['updateval']=="0") {
                    $this->updateval = 1;
                }
                
            }
       }   
       
       $this->cleanupSiteMaps();
       //$this->addSiteMapJob();
        
        
    }
    
    function updateSiteMapJob() {
        global $entity;
        $row = array();
        $row['name'] = "SITEMAPJOB ".date("Y-m-d H:i:s");
        $row['jobstatus'] = "pending";
        $row['offsetval'] = "0";
        $row['updateval'] = $this->updateval;
        
        $entity->save("sitemapjob",$row);  
    }
    
    function cleanupSiteMaps() {
        global $db,$vjconfig;
       // $sql = "delete from sitemapjob";
       // $db->query($sql);
        $sql= "delete from sitemap";
        $db->query($sql);
        
        
        $dir = "sitemaps";
        
        $files = scandir($dir);
        unset($files[0]);
        unset($files[1]);
        
        foreach($files as $file) {
            unlink($vjconfig['basepath']."sitemaps/".$file);
        }
    }

    
}


