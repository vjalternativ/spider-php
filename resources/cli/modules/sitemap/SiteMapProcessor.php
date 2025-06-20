<?php
$vjconfig = lib_config::getInstance()->getConfig();
require_once $vjconfig['fwbasepath'] . 'resources/backend/modules/sitemapjob/SitemapJobRuntime.php';

class SiteMapProcessor
{

    public $job;

    public $offset;

    public $sitemap = false;

    public $linksperfile = 40000;

    public $processpages = 1000;

    public $path = '';

    public $sitemapbasepath = '';

    private $logger;

    private $sitemapUpdateVal = 0;

    function __construct($row, $path, $sitemapbasepath)
    {
        $this->job = $row;
        $this->path = $path;
        $this->sitemapbasepath = $sitemapbasepath;
    }

    public function execute($loopindex = 0)
    {
        $db = lib_database::getInstance();
        $globalModuleList = lib_datawrapper::getInstance()->get("module_list");

        $row = $this->job;

        $this->offset = $row['rowindex'] ? $row['rowindex'] : 0;

        $index = floor($this->offset / $this->linksperfile) + 1;

        $file_name = $this->path . 'sitemap-' . $index . '.xml';

        $isnew = true;

        $processSiteMap = false;
        if (file_exists($file_name)) {
            $isnew = false;
            $sql = "select * from sitemap where page_module	='" . $row['page_module'] . "' order by date_entered desc limit 1";
            $this->sitemap = $db->getrow($sql);
            if ($this->sitemap) {
                $processSiteMap = true;
            }
        } else {
            $processSiteMap = true;
        }

        $module = $row['page_module'];

        if ($processSiteMap && $module && isset($globalModuleList[$module])) {
            $this->processXmlData($index, $isnew, $module, $loopindex);
        }
    }

    function updateXml($data, $counter, $index)
    {
        $entity = lib_entity::getInstance();
        $file = $this->path . 'sitemap-' . $index . '.xml';
        $xmlDoc = new DOMDocument();
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->formatOutput = true;
        $xmlDoc->load($file);
        $cnodes = $xmlDoc->getElementsByTagName("urlset");
        $cnode = $cnodes->item(0);

        $this->processNode($xmlDoc, $cnode, $data);

        $xmlDoc->save($file);
        $this->sitemap['links'] = $counter;
        $this->sitemap['page_module'] = $this->job['page_module'];
        $entity->save("sitemap", $this->sitemap);
    }

    private function getPageSqlQuery($module)
    {
        $qry = $this->getPageSql($module);

        return $qry;
    }

    private function getPageSql($module)
    {
        $sql = "select id,name,alias,date_modified from " . $module . " where   alias is not null  and (sitemap is null or sitemap != '" . $this->job['token'] . "')";

        $sql .= "   limit " . $this->processpages;
        echo $sql . PHP_EOL;

        $qry = lib_database::getInstance()->query($sql);
        return $qry;
    }

    function markSitemapJobCompleted()
    {
        $this->job['offsetval'] = 0;
        $this->job['jobstatus'] = "completed";
    }

    function processXmlData($index, $isNew, $module, $loopindex = 0)
    {
        echo "going to process xml for module " . $module . PHP_EOL;
        $db = lib_database::getInstance();
        $vjconfig = lib_config::getInstance()->getConfig();

        $data = array();
        $data['childs'] = array();
        $havePages = false;

        $qry = $this->getPageSqlQuery($module);
        $counter = 0;

        if (! $isNew) {
            $counter = $this->sitemap['links'];
        }

        $rows = array();
        while ($row = $db->fetch($qry)) {
            $rows[] = $row;
        }

        foreach ($rows as $row) {

            $date = new DateTime($row['date_modified']);
            $timestamp = $date->format("Y-m-d") . "T" . $date->format("H:i:sP");

            $this->offset ++;

            $row['alias'] = trim($row['alias']);
            if (empty($row['alias'])) {
                continue;
            }

            $prefix = $this->job['page_prefix'];
            $baseurl = $vjconfig['baseurl'];
            if ($row['alias'] == "page" || $row['alias'] == "home") {
                $row['alias'] = '';
                $prefix = "";
                $baseurl = rtrim($baseurl, "/");
            }
            $urlNode = array();
            $urlNode['element'] = "url";
            $urlNode['childs'] = array();
            $havePages = true;
            $loc = array();
            $loc['element'] = "loc";
            $loc['val'] = $baseurl . $prefix . $row['alias'];
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

            $sql = "update " . $module . " set sitemap = '" . $this->job['token'] . "' where id='" . $row['id'] . "'";
            $db->query($sql);
            $counter ++;
        }
        $this->job['offsetval'] = $this->offset;

        if ($havePages) {
            $this->job['jobstatus'] = "inprogress";
            if ($isNew) {
                $this->createXML($data, $counter, $index);
            } else {
                $this->updateXml($data, $counter, $index);
            }
            $loopindex ++;
            lib_entity::getInstance()->save("sitemapjob", $this->job);
            $this->execute($loopindex);
        }
    }

    function processNode($xmlDoc, &$node, $data)
    {
        $cnode = false;
        if (isset($data['val'])) {
            $cnode = $node->appendChild($xmlDoc->createElement($data['element'], $data['val']));
        } else {

            if (isset($data['element'])) {
                $cnode = $node->appendChild($xmlDoc->createElement($data['element']));
            } else {
                $cnode = $node;
            }
        }
        if (isset($data['attributes'])) {
            foreach ($data['attributes'] as $key => $val) {
                $cnode->setAttribute($key, $val);
            }
        }

        if (isset($data['childs'])) {
            foreach ($data['childs'] as $cdata) {
                if (isset($cdata['element'])) {
                    $this->processNode($xmlDoc, $cnode, $cdata);
                }
            }
        }
    }

    function createXML($childdata, $counter, $index)
    {
        $entity = lib_entity::getInstance();
        $xmlDoc = new DOMDocument("1.0", "UTF-8");

        $data = array();
        $data['element'] = "urlset";
        $data['attributes'] = array();
        $data['attributes']['xmlns'] = "http://www.sitemaps.org/schemas/sitemap/0.9";
        $data['attributes']['xmlns:xsi'] = "http://www.w3.org/2001/XMLSchema-instance";
        $data['attributes']['xsi:schemaLocation'] = "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd";
        $data['childs'] = $childdata['childs'];

        if (isset($data['element'])) {
            $this->processNode($xmlDoc, $xmlDoc, $data);
        }

        // make the output pretty
        $xmlDoc->formatOutput = true;

        // save xml file
        $file_name = 'sitemap-' . $index . '.xml';
        $xmlDoc->save($this->path . $file_name);

        $data = array();
        $data['name'] = $file_name;
        $data['filepath'] = $this->sitemapbasepath . $file_name;
        $data['links'] = $counter;
        $data['page_module'] = $this->job['page_module'];
        $entity->save("sitemap", $data);
    }
}

?>