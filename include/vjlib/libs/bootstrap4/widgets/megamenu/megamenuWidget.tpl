<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/libs/bootstrap4/widgets/megamenu/webslidemenu/fade-down.css" />
<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/libs/bootstrap4/widgets/megamenu/webslidemenu/webslidemenu.css" />
<link rel="stylesheet" href="{$fwbaseurl}include/vjlib/libs/bootstrap4/widgets/megamenu/webslidemenu/white-gry.css" />


<script src="{$fwbaseurl}include/vjlib/libs/bootstrap4/widgets/megamenu/webslidemenu/webslidemenu.js"></script>

<div class="headerfull">
    <div class="wsmain clearfix">
      <div class="smllogo">
      	<a href="{$baseurl}"><img src="{$baseurl}{$params.logo.src}" width="50" height="40"  alt="" /></a>
      </div>

<nav class="wsmenu clearfix">
        <ul class="wsmenu-list">
    
    {foreach from=$params.headermenu key=key item=item}
     
     {if $item.type && $item.type eq "mega"}
     
              
          <li aria-haspopup="true" ><a href="#" class="navtext dropdown-toggle">{$item.name}</a>
            <div class="wsshoptabing wtsdepartmentmenu clearfix">
              <div class="wsshopwp clearfix">
                <ul class="wstabitem clearfix">
                  
          {if $item.menu}
                 {foreach from=$item.menu key=catkey item=catitem}
                  
                  <li class="{if $catitem.isfirst}wsshoplink-active{/if}"><a href="#"><i class="fas fa-female"></i> {$catitem.name}</a>
                    <div class="wstitemright clearfix {if $catitem.isfirst}wstitemrightactive{/if}">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-8 col-md-12 clearfix">
                            <div class="wstheading clearfix">{$catitem.name}</div>
                            
                            {if $catitem.menu}
                      
                      
                            <ul class="wstliststy01 clearfix">
                      
                      		{foreach from=$catitem.menu key=subcatkey item=subcatitem}
                      
                            
                            
                              <li><a href="{$subcatitem.alias}">{$subcatitem.name} <span class="wstmenutag"></span></a></li>
							{/foreach}

                            </ul>
                            
                            {/if}
                           
                          </div>
                           </div>
                      </div>
                    </div>
                  </li>
                  {/foreach}
                 {/if} 
                  

                </ul>
    
              </div>
            </div>
          </li>
		{else}
		<li><a href="{$item.alias}" class="navtext">{$item.name}</a></li>
		{/if}
		{/foreach}
    
    


 
 

 



          <li aria-haspopup="true" class="wsshopmyaccount"><a href="#"><i class="fas fa-align-justify"></i>My&nbsp;Account</a>
            <ul class="sub-menu">
              <li><a href="#"><i class="fas fa-user-tie"></i>View Profile</a></li>
              <li><a href="#"><i class="fas fa-heart"></i>My Wishlist</a></li>
              <li><a href="#"><i class="fas fa-bell"></i>Notification</a></li>
              <li><a href="#"><i class="fas fa-question-circle"></i>Help Center</a></li>
              <li><a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            </ul>
          </li>


        </ul>
      </nav>
      
      </div>
      </div>
<div class="clearfix"></div>


{*

<div class="card  rounded-0 border-top-0 border-right-0" >
    <div class="card-body padding-10">
    			








<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
 
  
 
  <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none"><img src="{$baseurl}{$params.logo.src}"  width="70" height="40" /></a>
 
 
  <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
          <span class="navbar-toggler-icon"></span>
      </button>
  <div id="navbarContent" class="collapse navbar-collapse">
    <ul class="navbar-nav ">
      <!-- Megamenu-->
  
  <li class="nav-item">
  
  	<a href="{$baseurl}" class="nav-link border"><img src="{$baseurl}{$params.logo.src}"  width="50" height="20" /></a>
  
  </li>
           
     {foreach from=$params.headermenu key=key item=item}
     
     {if $item.type && $item.type eq "mega"}
     		
     	<li class="nav-item dropdown megamenu">
     		<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle font-weight-bold text-uppercase">
     			{$item.name}
     		</a>
     		
     		   <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">
          <div class="container border padding-0">
            <div class="row bg-white rounded-0 m-0 shadow-sm">
              <div class="col-lg-12 col-xl-12">
                <div class="p-4">
                  <div class="row">
                    
                    
                    {if $item.menu}
                    
                    	{foreach from=$item.menu key=catkey item=catitem}
                    	
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xm-12 margin-top-10">
                      <a href="{$baseurl}{$catitem.alias}" class="font-weight-bold text-uppercase megamenu-category">
                      	{$catitem.name}
                      </a>
                      
                      {if $catitem.menu}
                      
                      
                      <ul class="list-unstyled">
                      
                      	{foreach from=$catitem.menu key=subcatkey item=subcatitem}
                      	<li class="nav-item"><a href="{$baseurl}{$subcatitem.alias}" class="nav-link text-small pb-0 link">{$subcatitem.name}</a></li>
                        
                      	{/foreach}
                      </ul>
                      
                      {/if}
                    </div>
                    	
                    	{/foreach}
                    
                    {/if}
                    
                
             
       
                  </div>
                </div>
              </div>
 
             <div class="col-lg-5 col-xl-4 px-0 d-none d-lg-block" style="background: center center url(https://res.cloudinary.com/mhmd/image/upload/v1556990826/mega_bmtcdb.png)no-repeat; background-size: cover;"></div> 

            </div>
          </div>
        </div>
     		
     		
         </li>
         
     {else}
         
     	<li class="nav-item">
     		<a href="{$item.alias}" class="nav-link font-weight-bold text-uppercase">
     		  {$item.name}
     		</a>
         </li>
         
     {/if}
     
     {/foreach}
      
    </ul>
  </div>
</nav>



    </div>
</div>
*}

{*
https://uxwing.com/menudemo/webslide/mobile-drawer-style/layout-03-ecommerce/
*}