<?php 
interface IWidgetService {
    function getWidget($widgetType);
    function getWidgetForParams($widgetType,$params);
    function getWidgetForPage($widgetType,$orderByName=false);
    function getWidgetForRecord($row,$orderByName=false);
    
}
?>