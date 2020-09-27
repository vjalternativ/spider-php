<?php
class spiderCliController extends CliResourceController {
    function action_install() {
        $datapatch = new SchemaDataPatcher();
        $datapatch->addRepairTable("user");
        $datapatch->repairFramework();
    }
}
?>