<div class="card mb-2 {if !$params.title}border-0{/if}">
	
	{if $params.title}
	<div class="card-body bg-primary text-white">
	
		<b>{$params.title}</b>
	</div>
	{/if}
	
	<div class="card-body {if !$params.title}p-0{/if}" >
		
		{foreach from=$params.data item=row}
		
			<div class="row mb-2">
			
				{foreach from=$row item=card}
					<div class="{if $card.size}col-sm-{$card.size}{else}col-sm{/if}">
						
						{$card.content}
											
					</div>
					
					{/foreach}
			</div>
			
		 {/foreach}
	</div>
	
</div>
