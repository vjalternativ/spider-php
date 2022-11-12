<?php

class SitemapJobLogicHook
{

    function beforeSave(&$data)
    {
        if ($data['jobstatus'] == "queued") {
            $data['rowindex'] = "0";
        }
    }
}
?>