<div class="card mb-2 {if !$params.title}border-0{/if}">
	
	{if $params.title}
	<div class="card-body bg-primary text-white">
	
		<b>{$params.title}</b>
	</div>
	{/if}
	
	<div class="card-body ">
		
		{foreach from=$params.data item=row}
		
			<div class="row mb-2">
			
				{foreach from=$row item=card}
					<div class="col-sm">
						
						{$card}
											
					</div>
					
					{/foreach}
			</div>
			
		 {/foreach}
	</div>
	
</div>
