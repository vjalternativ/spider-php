<!-- Nav tabs -->
<ul class="nav nav-tabs">
  
  {foreach from=$params.tabs key=key item=tab}
  <li class="nav-item">
    <a class="nav-link {if $tab.isfirstrow}active{/if}" data-toggle="tab" href="#tab-{$params.id}-{$key}">{$tab.name}</a>
  </li>
  {/foreach}
</ul> 

<!-- Tab panes -->
<div class="tab-content">
  {foreach from=$params.tabs item=tab key=key}
  <div class="tab-pane container border border-top-0 pt-2 pb-2 bg-white {if $tab.isfirstrow}active{else}fade{/if}" id="tab-{$params.id}-{$key}">
  	
  	{if $tab.content}
  		{$tab.content}
  	{/if}
  	
  	
  	{if $tab.items}
  	{foreach from=$tab.items item=row}
  			<div class="card">
			<div class="card-body">{$row.name}</div>
			</div>
	{/foreach} 
  	{/if}
  	
  		<div class="clearfix"></div>
  	
  </div>
	
  {/foreach}
</div>

<br />