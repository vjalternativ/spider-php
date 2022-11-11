<?php

class seo_templateCliController extends CliResourceController
{

    function action_sync()
    {
        $db = lib_database::getInstance();

        $sql = "select * from seo_template where status='queued' order by date_entered desc limit 1";
        $seoTemplate = $db->getrow($sql);
        if ($seoTemplate) {

            $module = $seoTemplate['module'];
            $rowindex = $seoTemplate['rowindex'];
            $sql = "select * from " . $module . " order by date_entered asc limit " . $rowindex . ",1000 ";
            $rows = $db->getAll($sql);
            if ($rows) {

                $metaTitle = $seoTemplate['meta_title'];
                $metaDesc = $seoTemplate['meta_desc'];
                $metaKey = $seoTemplate['meta_key'];
                foreach ($rows as $row) {
                    $row['meta_title'] = str_replace("@name", $row['name'], $metaTitle);
                    $row['meta_desc'] = str_replace("@name", $row['name'], $metaDesc);
                    $row['meta_key'] = str_replace("@name", $row['name'], $metaKey);
                    lib_database::getInstance()->update($module, $row, "id");
                }

                $seoTemplate['rowindex'] = $rowindex + count($rows);
                $seoTemplate['status'] = "inprogress";
                $db->update("seo_template", $seoTemplate, "id");
            } else {
                $seoTemplate['status'] = "completed";
            }
        }
    }
}
?>