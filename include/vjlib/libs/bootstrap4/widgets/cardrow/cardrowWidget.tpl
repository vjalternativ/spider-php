<div class="card">
	<div class="card-body bg-primary text-white">
		<b>{$params.title}</b>
	</div>
	<div class="card-body">
		
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
