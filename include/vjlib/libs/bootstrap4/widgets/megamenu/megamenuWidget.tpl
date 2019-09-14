<div class="card  rounded-0 border-top-0" >
    <div class="card-body padding-10">
    			








<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
 
  
 
  <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none"><img src="{$params.logo.src}"  width="70" height="40" /></a>
 
 
  <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
          <span class="navbar-toggler-icon"></span>
      </button>
  <div id="navbarContent" class="collapse navbar-collapse">
    <ul class="navbar-nav ">
      <!-- Megamenu-->
  
  <li class="nav-item">
  
  	<a href="#" class="nav-link border"><img src="{$params.logo.src}"  width="50" height="20" /></a>
  
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
              <div class="col-lg-7 col-xl-8">
                <div class="p-4">
                  <div class="row">
                    
                    
                    {if $item.menu}
                    
                    	{foreach from=$item.menu key=catkey item=catitem}
                    	
                    <div class="col-lg-6 mb-4">
                      <h6 class="font-weight-bold text-uppercase">{$catitem.name}</h6>
                      
                      {if $catitem.menu}
                      
                      
                      <ul class="list-unstyled">
                      
                      	{foreach from=$catitem.menu key=subcatkey item=subcatitem}
                      	<li class="nav-item"><a href="" class="nav-link text-small pb-0">{$subcatitem.name}</a></li>
                        
                      	{/foreach}
                      </ul>
                      
                      {/if}
                    </div>
                    	
                    	{/foreach}
                    
                    {/if}
                    
                
             
       
                  </div>
                </div>
              </div>
{* 
             <div class="col-lg-5 col-xl-4 px-0 d-none d-lg-block" style="background: center center url(https://res.cloudinary.com/mhmd/image/upload/v1556990826/mega_bmtcdb.png)no-repeat; background-size: cover;"></div> 
*}
            </div>
          </div>
        </div>
     		
     		
         </li>
         
     {else}
         
     	<li class="nav-item">
     		<a  class="nav-link font-weight-bold text-uppercase">
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
