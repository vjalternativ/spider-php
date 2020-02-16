<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
  {$vjconfig|@debug_print_var}
    {foreach from=$params item=slide}
    <div class="carousel-item {if $slide.isfirst}active{/if}">
      <img src="{$vjconfig.fwurlbassepath}index.php?module=media_files&action=download&id={$slide.attrs.image}" alt="">
    </div>
    {/foreach}
    
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>