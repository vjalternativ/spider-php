  

<div id="cardcarousel" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#cardcarousel" data-slide-to="0" class="active"></li>
    <li data-target="#cardcarousel" data-slide-to="1"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    {foreach from=$params.cardslides item=slidelist}
    <div class="carousel-item {if $slide.active}active{/if}">
    	
    			<div class = "row">
    	
    				{foreach from=$slidelist item=slideitem} 
    					<div class="col-sm">
    					<div classs="d-block w-100">
    						<div class="card">
    								<div class="card-body">
    								body
    								</div>
    								<div class="card-footer">
    									hello
    								</div>
    							
    							</div>
    						
    					</div>
    							
    					</div>
    				{/foreach}
    		</div>
    </div>
    {/foreach}
    
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#cardcarousel" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#cardcarousel" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

{literal}
<script>
$('#cardcarousel').carousel({
    interval: 5000
});
</script>

{/literal}