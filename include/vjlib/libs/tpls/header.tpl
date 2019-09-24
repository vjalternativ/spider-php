<!DOCTYPE html>
<html>
<head>


{foreach from=$bs.cssList item=css}

{$css}
{/foreach}
<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/assets/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/assets/css/jquery-ui.css" />
<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/assets/css/jquery-ui.css" />

<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/assets/css/bootstrap-datetimepicker.css" />

<script src="{$fwbaseurl}include/vjlib/assets/js/jquery-3.1.1.min.js"></script>




</head>
<body>

<div class="container-fluid bg-primary padding-10">
<a class="h1 a-none logo-label" href="{$baseurl}">{$vjconfig.sitename}</a>
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
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{$menuinfo.menu|upper}
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        
        
		     {foreach from=$menuinfo.items key=tableinfo_id item=menudata}		
		          <li><a href="index.php?module={$menudata.name}">{$menudata.module|upper}</a></li>
		     {/foreach}
        </ul>
      </li>
    {/foreach}
     
     
     </ul>
  </div>
</nav>
{/if} 
<div class="container-fluid margin-top-10"> 





