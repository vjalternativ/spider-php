{if $panel.formaction}

<form method="post" action="{$panel.formaction}" >
{/if}
<div class="panel panel-{$panel.type}">

	<div class="panel-heading">
		<span class="h3 heading">{$panel.heading}</span>
	
	</div>
	<div class="panel-body">
			{$panel.body}
	
	</div>
	
	{if $panel.footer}
	<div class="panel-footer">
	{if $panel.savebutton}	<button type="submit" class="btn btn-primary">Save</button> {/if}
	</div>
	
	{/if}
</div>

{if $panel.formaction}
</form>
{/if}