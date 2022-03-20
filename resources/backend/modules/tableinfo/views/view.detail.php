<?php
require_once 'spider-php/resources/backend/modules/tableinfo/LayoutManagerService.php';

class tableinfoViewDetail extends ViewDetail
{

    function display()
    {
        parent::display();
        echo LayoutManagerService::getInstance()->getLayoutMangerHTML($this->data, "tableinfo", $this->data);
    }
}
?>