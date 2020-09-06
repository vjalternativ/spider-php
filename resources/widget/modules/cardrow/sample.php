<?php


$rows = array();
//get rows from anywhere either from database or existing array


$cardrowWidget = new cardrowWidget();


foreach($rows as $row) {
    
    $params = array();
    $params['header'] = 'html ka code ';
    
    $params['body'] = '';
    
    
    $cardrowWidget->addcard($params);
    
}


$widgetKaHTML = $cardrowWidget->getWidget();



