# create widget in resource widget

# register your config field by using registerConfigField in controller constructor.


# create a page from backend page module

# create a widget for that page from page detail view with widget type which you have created.


# in pageFrontendController check the seoParams index 0 if alias is coming

# then get the widget by calling

WidgetServiceRegistrar::getWidgetServiceInstance()->getWidgetForPage("<widgettype>");

# assign widget into params and  rendor this widget on the tpl