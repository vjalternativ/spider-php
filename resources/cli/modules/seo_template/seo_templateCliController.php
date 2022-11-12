<?php
$fwbasepath = lib_config::getInstance()->get("fwbasepath");
require_once $fwbasepath . 'resources/backend/modules/seo_template/SEOTemplateService.php';

class seo_templateCliController extends CliResourceController
{

    function action_sync()
    {
        $db = lib_database::getInstance();

        $sql = "select * from seo_template where deleted=0 status in ('queued','inprogress') order by date_entered asc limit 1";
        $seoTemplate = $db->getrow($sql);
        if ($seoTemplate) {

            $table = $seoTemplate['module'];
            $rowindex = $seoTemplate['rowindex'];
            $sql = "select * from " . $table . " order by date_entered asc limit " . $rowindex . ",1000 ";
            $rows = $db->getAll($sql);
            if ($rows) {
                $seoTemplateService = SEOTemplateService::getInstance();
                foreach ($rows as $row) {
                    $seoTemplateService->updateSEOForRecord($seoTemplate, $table, $row);
                }

                $seoTemplate['rowindex'] = $rowindex + count($rows);
                $seoTemplate['status'] = "inprogress";
            } else {
                $seoTemplate['status'] = "completed";
            }
            $db->update("seo_template", $seoTemplate, "id");
        }
    }
}
?>