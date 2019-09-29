<!-- Nav tabs -->
<ul class="nav nav-tabs">
  
  {foreach from=$params.tabs item=tab}
  <li class="nav-item">
    <a class="nav-link {if $tab.isfirst}active{/if}" data-toggle="tab" href="#tab-{$tab.id}">{$tab.name}</a>
  </li>
  {/foreach}
</ul> 

<!-- Tab panes -->
<div class="tab-content">
  {foreach from=$params.tabs item=tab}
  <div class="tab-pane container border border-top-0 pt-2 pb-2 {if $tab.isfirst}active{else}fade{/if}" id="tab-{$tab.id}">
  	{foreach from=$tab.items item=row}
  			<div class="card">
			<div class="card-body">{$row.name}</div>
			</div>
		{/foreach} 
  
  </div>
	
  {/foreach}
</div>
