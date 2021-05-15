<?php

class spiderCliController extends CliResourceController
{

    function action_install()
    {
        echo "generating cache" . PHP_EOL;
        lib_entity::getInstance()->generateCache();
        echo "cache generated " . PHP_EOL;
        require_once lib_config::getInstance()->get('fwbasepath') . 'resources/backend/modules/adminarea/SchemaDataPatcher.php';
        $datapatch = new SchemaDataPatcher();
        $datapatch->addRepairTable("user");
        $datapatch->repairFramework();
    }
}
?>