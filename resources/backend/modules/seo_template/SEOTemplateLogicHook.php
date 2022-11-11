<?php

class SEOTemplateLogicHook
{

    function beforeSave(&$data)
    {
        $data['status'] = 'queued';
        $data['rowindex'] = "0";
    }
}
?>