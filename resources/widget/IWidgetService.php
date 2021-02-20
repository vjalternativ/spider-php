<?php
namespace spider\resources\widget;

interface IWidgetService {
    function getWidget($widgetType);
    function getWidgetForParams($widgetType,$params);
    function getWidgetForPage($widgetType,$orderByName=false);
    function getWidgetForRecord($row,$orderByName=false);
    function getWidgetFileds($widgetType);
    function getWidgetAtPosition($pos,$orderByName=false);
    function getWidgetConfigFields($widgetType);
}
?>