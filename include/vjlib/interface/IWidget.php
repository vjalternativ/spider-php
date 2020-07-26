<?php 
interface IWidget {
    function getWidget($widgetType);
    function getWidgetByParams($widgetType,$params);
}
?>