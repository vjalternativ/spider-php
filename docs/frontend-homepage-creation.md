# in pageFrontendController.php we can write the code for homepage.


# for home page we can edit resources/frontend/modules/page/tpls/v1/home.tpl

# what is params property in controller ?


# params property in controller is shared in views as well as tpl also by framework.. hence to share data between controller views and tpls we can set data into params.	



# to assign data on tpl we could directly set data into params in controller and that will be accessible to tpl.

#For eg
	
	Controller
		$this->params['key'] = $value;
		
	we can assess key in tpl as {$params.key}		





	