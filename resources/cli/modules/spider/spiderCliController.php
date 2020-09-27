<?php
class spiderCliController extends CliResourceController {
    function action_install() {

        require_once lib_config::getInstance()->get('fwbasepath').'resources/backend/modules/adminarea/SchemaDataPatcher.php';
        $datapatch = new SchemaDataPatcher();
        $datapatch->addRepairTable("user");
        $datapatch->repairFramework();
    }
}
?>