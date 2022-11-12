<?php

class SEOTemplateService
{

    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SEOTemplateService();
        }

        return self::$instance;
    }

    public function getUpdatedSEORecord($seoTemplate, $table, $row)
    {
        $metaTitle = $seoTemplate['meta_title'];
        $metaDesc = $seoTemplate['meta_desc'];
        $metaKey = $seoTemplate['meta_key'];
        $row['meta_title'] = str_replace("@name", $row['name'], $metaTitle);
        $row['meta_desc'] = str_replace("@name", $row['name'], $metaDesc);
        $row['meta_key'] = str_replace("@name", $row['name'], $metaKey);
        return $row;
    }

    public function updateSEOForRecord($seoTemplate, $table, $row)
    {
        $row = $this->getUpdatedSEORecord($seoTemplate, $table, $row);
        lib_database::getInstance()->update($table, $row, "id");
    }

    public function getSEOTemplateForModule($module)
    {
        $sql = "select * from seo_template where module='" . $module . "' and deleted=0 ";

        return lib_database::getInstance()->getrow($sql);
    }
}
?>