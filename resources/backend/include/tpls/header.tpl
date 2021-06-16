<!DOCTYPE html>
<html>
<head>


{foreach from=$bs.cssList item=css}

{$css}
{/foreach}
<link rel="stylesheet" href="{$fwbaseurl}resources/backend/assets/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="{$fwbaseurl}resources/backend/assets/css/jquery-ui.css" />
<link rel="stylesheet" href="{$fwbaseurl}resources/backend/assets/css/jquery-ui.css" />

<link rel="stylesheet" href="{$fwbaseurl}resources/backend/assets/css/bootstrap-datetimepicker.css" />

<link rel="stylesheet" href="{$fwbaseurl}resources/backend/assets/css/bootoast.css" />

<script src="{$fwbaseurl}resources/backend/assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="{$fwbaseurl}resources/backend/include/lib/js/transliteration-input-tools/transliteration-input.bundle.js"></script>

<script src="{$fwbaseurl}resources/backend/assets/js/bootoast.js" ></script>

<script type="text/javascript" src="{$urlscheme}://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="{$fwbaseurl}thirdparty/client/ckeditor/plugins/ckeditor_wirs/integration/WIRISplugins.js?viewer=image"></script>

<script>
var resource = "backend";
</script>

</head>
<body>

<div class="container-fluid bg-primary padding-10">
<a class="h2 a-none logo-label" href="{$baseurl}backend">{$vjconfig.sitename}</a>
{if $logout}
	{$logout}
	{$adminarea} 
<a href="index.php?module=user&action=changePwd&record={$current_user->id}">
		<button type="button" class="btn btn-success pull-right margin-right-10">Change Password</button>
	</a>
	<a href="index.php?module=user&action=detailview&record={$current_user->id}">
		<button type="button" class="btn btn-success pull-right margin-right-10">User Preferece</button>
	</a>
{/if}
{$bs.clearfix}

</div>



{if $logout}
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
   
    <ul class="nav navbar-nav">
    
    {foreach from=$menudata key=menu_id item=menuinfo}		
      <li class="{if $menuinfo.isactive_menu} active {/if}">
      <a href="index.php?module={$menuinfo.first_module_name}">{$menuinfo.menu_name|upper} </a>
      </li>
      <li class="dropdown hide">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{$menuinfo.menu_name|upper}
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        
        
		     {foreach from=$menuinfo.items key=tableinfo_id item=menu}		
		          <li><a href="index.php?module={$menu.name}">{$menu.name|upper}</a></li>
		     {/foreach}
        </ul>
      </li>
    {/foreach}
     
     
     </ul>
  </div>
</nav>
{/if} 
<div class="container-fluid margin-top-10"> 


{if $activeSubmenuId}

<ul class="nav nav-tabs">
  		{assign var=menuinfo value=$menudata[$activeMenuId]}
  	    
  	     {foreach from=$menuinfo.items key=submenu_id item=smenudata}		
		          <li class="{if $smenudata.isactive_submenu}active{/if} "><a href="index.php?module={$smenudata.first_module_name}">{$smenudata.submenu_name|upper}</a></li>
		 {/foreach}
    
 </ul>
<div class="clearfix"></div>
<br />
{/if}

{if $activeMenuId}

<ul class="nav nav-tabs">

  		{assign var=activemenuinfo value=$menudata[$activeMenuId]}
		{if $activeSubmenuId}
  		
  		{assign var=submenuinfo value=$activemenuinfo.items[$activeSubmenuId]}
		 
	     
		 		{foreach from=$submenuinfo.items key=mdid item=moduledata}		
		 
		          	<li class="{if $activeModuleId==$mdid}active{/if} pull-right"><a href="index.php?module={$moduledata.name}">{$moduledata.name|upper}</a></li>
		 		{/foreach}
		 {/if}

  		{assign var=menuinfo value=$menudata[$activeMenuId]}
  	    
  	   	{if $menuinfo.module_items}
  	     {foreach from=$menuinfo.module_items key=mdid item=menudata}		
		          <li class="{if $activeModuleId == $mdid}active{/if} pull-right"><a href="index.php?module={$menudata.name}">{$menudata.name|upper}</a></li>
		 {/foreach}
   		{/if}
 </ul>
<div class="clearfix"></div>
<br />
{/if}

{*

{if $activeMenuId}

<ul class="nav nav-tabs">
  		{assign var=menuinfo value=$menudata[$activeMenuId]}
  	    
  	     {foreach from=$menuinfo.items key=tableinfo_id item=menudata}		
		          <li class="{if $menudata.isactive_submenu}active{/if} pull-right"><a href="index.php?module={$menudata.name}">{$menudata.module|upper}</a></li>
		 {/foreach}
    
 </ul>
<div class="clearfix"></div>
<br />
{/if}

*}