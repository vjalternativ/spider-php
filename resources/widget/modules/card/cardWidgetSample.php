<?php 

$params = array();
        $params['header'] = '<h1>card heading</h1>';
        $params['body'] = '<h1>card body</h1>';
        
       $html = AWidget::loadWidget("card", $params); 