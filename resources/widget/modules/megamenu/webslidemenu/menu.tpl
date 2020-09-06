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
                      
                            
                            
                              <li><a href="{$baseurl}{$subcatitem.alias}">{$subcatitem.name} <span class="wstmenutag"></span></a></li>
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
https://uxwing.com/menudemo/webslide/mobile-drawer-style/layout-03-ecommerce/
