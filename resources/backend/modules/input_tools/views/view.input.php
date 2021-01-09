<?php
require_once 'spider-php/resources/backend/include/views/view.basic.php';

class input_toolsViewInput extends ViewBasic {

    function display() {
        $this->html = $this->loadTpl("input.tpl");
        parent::display();
    }
}
?>