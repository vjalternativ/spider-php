<?php 
interface IWidgetService {
    function getWidget($widgetType);
    function getWidgetForParams($widgetType,$params);
    function getWidgetForPage();
}
?>