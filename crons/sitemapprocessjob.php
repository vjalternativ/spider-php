<?php
global $vjconfig;
require_once $vjconfig['fwbasepath'].'include/vjlib/interface/CronJob.php';

class SiteMapProcessJob implements CronJob
{

    public $job;
    public $offset;
    public $sitemap = false;
    public $linksperfile = 40000;
    public $processpages = 1000;
    
    public function execute()
    {
        global $db,$globalModuleList,$vjconfig;

        
        $sql = "select * from sitemapjob where deleted=0 and  jobstatus='pending' limit 1";
        $row = $db->getRow($sql);
        if ($row) {
            if($row['updateval']=="") {
                $row['updateval'] =0;
            }
            $this->job = $row;
            $this->offset = $row['offsetval'];

            $index = floor($this->offset / $this->linksperfile) + 1;
            
            $file_name = $vjconfig['basepath'].'sitemaps/sitemap-'.$index.'.xml';
            
            $isnew = true;
            
            if(file_exists($file_name)) {
                $isnew = false;
                $sql = "select * from sitemap where id='".$row['lastsitemap']."'";
                $this->sitemap = $db->getRow($sql);
            } 
            
            
            $module = $row['page_module'];
            if($module && isset($globalModuleList[$module])) {
                $this->processXmlData($index,$isnew,$module);
            }
                        
        }
    }
    
    
    
    
    
    function updateXml($data,$counter,$index) {
        
        global $entity,$vjconfig;
        $file = $vjconfig['basepath'].'sitemaps/sitemap-'.$index.'.xml';
        
        $xmlDoc = new DOMDocument();
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->formatOutput = true;
        $xmlDoc->load($file);
        $cnodes = $xmlDoc->getElementsByTagName("urlset");
        $cnode = $cnodes->item(0);
        
        $this->processNode($xmlDoc, $cnode, $data);
        
        $xmlDoc->save($file);
        $this->sitemap['links'] = $counter;
        $entity->save("sitemap",$this->sitemap);
        
        
    }

    function processXmlData($index,$isNew,$module)
    {   
        global $db,$entity,$vjconfig,$log;
        $data = array();
        $data['childs'] = array();
        $havePages = false;

        $date = date("Y-m-d");
        $timestamp = $date . 'T00:00:00+00:00';

        $sql = "select id,name,alias from ".$module." where   alias is not null  and sitemap = ".$this->job['updateval'];
        $updateval = 0;
        if($this->job['updateval']=="0") {
            $sql.= " or sitemap is null";
            $updateval = 1;
        }
        $sql .=")   limit " .$this->processpages;
        $log->fatal("process sitemap query ".$sql);
        $qry = $db->query($sql);
        $counter = 0;
        
        if(!$isNew) {
            $counter = $this->sitemap['links'];
        }
        while ($row = $db->fetch($qry)) {
            
            $this->offset++;
            
            
            
            $row['alias'] = trim($row['alias']);
            if (empty($row['alias'])) {
                continue;
            }
            $urlNode = array();
            $urlNode['element'] = "url";
            $urlNode['childs'] = array();
            $havePages = true;
            $loc = array();
            $loc['element'] = "loc";
            $loc['val'] = $vjconfig['baseurl'] . $row['alias'];
            $urlNode['childs'][] = $loc;
            $lastmod = array();
            $lastmod['element'] = "lastmod";
            $lastmod['val'] = $timestamp;
            $urlNode['childs'][] = $lastmod;

            $priorty = array();
            $priorty['element'] = "priority";
            $priorty['val'] = "1";
            $urlNode['childs'][] = $priorty;
            $data['childs'][] = $urlNode;
            
            $sql = "update ".$module." set sitemap = ".$updateval." where id='".$row['id']."'";
            $db->query($sql);
            $counter ++;
        }
        $this->job['offsetval'] = $this->offset;
        
        
        if($havePages) {
            if($isNew) {
                $this->createXML($data,$counter,$index);
            } else {
                $this->updateXml($data,$counter,$index);
            }
        } else {
            $this->job['jobstatus'] = "completed";
        }
        $entity->save("sitemapjob",$this->job);
        
    }
    
    
    function processNode($xmlDoc,&$node,$data) {
        $cnode = false;
        if(isset($data['val'])) {
            $cnode = $node->appendChild($xmlDoc->createElement($data['element'],$data['val']));
            
        } else {
            
            if(isset($data['element'])) {
                $cnode = $node->appendChild($xmlDoc->createElement($data['element']));
            } else {
                $cnode = $node;
            }
        }
        if(isset($data['attributes'])) {
            foreach($data['attributes'] as $key=>$val){
                $cnode->setAttribute($key, $val);
            }
        }
        
        if(isset($data['childs'])) {
            foreach($data['childs'] as $cdata) {
                if(isset($cdata['element'])) {
                    $this->processNode($xmlDoc,$cnode, $cdata);
                }
            }
        }
        
        
    }
    
    function createXML ($childdata,$counter,$index) {
        global $entity,$vjconfig;
        $dir = "sitemaps";
        $xmlDoc = new DOMDocument("1.0","UTF-8");
        
        $data = array();
        $data['element'] = "urlset";
        $data['attributes'] = array();
        $data['attributes']['xmlns'] = "http://www.sitemaps.org/schemas/sitemap/0.9";
        $data['attributes']['xmlns:xsi'] = "http://www.w3.org/2001/XMLSchema-instance";
        $data['attributes']['xsi:schemaLocation'] = "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd";
        $data['childs'] = $childdata['childs'];
        
        
        if(isset($data['element'])) {
            $this->processNode($xmlDoc,$xmlDoc,$data);
        }
        
        //make the output pretty
        $xmlDoc->formatOutput = true;
        
        //save xml file
        $file_name = 'sitemap-'.$index.'.xml';
        $xmlDoc->save($vjconfig['basepath']."sitemaps/" . $file_name);
        
        
        $data = array();
        $data['name']  = $file_name;
        $data['filepath'] =  $vjconfig['baseurl'].$dir.'/'.$file_name;
        $data['links'] = $counter;
        $id = $entity->save("sitemap",$data);
        $this->job['lastsitemap'] = $id;
    }
}

?>