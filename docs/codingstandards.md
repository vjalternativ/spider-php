# How MVC works in Spider-PHP ?


# Resources - 
			- Bakend Resource
			- Frontend Resource
			- Rest Resource
			
Backend  - to interact with bakend and manage modules.
	  	

/backend/services/test - seo  

index.php?resource=backend&module=services&action=test

	resource - backend
	module - services
	function - action_test
	
	file - servicesBackendController.php
	path - resources/backend/modules/services/servicesBackendController.php



Frontend  - to interact with frontend UI
	  	
/services/test - seo  as default resource is frontend

/frontend/services/test - seo  

index.php?resource=frontend&module=services&action=test

	resource - frontend
	module - services
	function - action_test
	
	file - servicesFrontendController.php
	path - resources/frontend/modules/services/servicesFrontendController.php



Rest  - to provider data to end users interface in json format.
	  - Expose Mobile 
	  - ThirdParty Servers
	  	

/rest/services/test -seo  

index.php?resource=rest&module=services&action=test

	resource - rest
	module - services
	function -action_test
	
	file - servicesRestController.php
	path - resources/rest/modules/services/	servicesRestController.php
	

MVC -  

	Controller - URL Mapping -
			File Naming Convention - <modulename><ResourceName>Controller.php
			FilePath = resources/<resourcename>/modules/<modulename>/
	
	Model/Service - Module Specific Features and Operations -
			FilePath = resources/backend/modules/<modulename>/
	
	View - Wherever UI is requried (backend/frontend) , handling of tpls
			File naming convention - view.<viewname>.php
			FilePath = resources/<resourcename>/modules/<modulename/views/
