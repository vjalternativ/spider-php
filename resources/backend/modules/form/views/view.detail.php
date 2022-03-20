<?php
require_once 'spider-php/resources/backend/modules/tableinfo/LayoutManagerService.php';

class formViewDetail extends ViewDetail
{

    function afterDisplay()
    {
        $tableinfoRecord = lib_entity::getInstance()->getwhere("tableinfo", "name='" . $this->data['module'] . "'");

        if ($this->data['editviewdef']) {
            $tableinfoRecord['editviewdef'] = $this->data['editviewdef'];
        }

        echo LayoutManagerService::getInstance()->getLayoutMangerHTML($tableinfoRecord, "form", $this->data);
    }
}
?>