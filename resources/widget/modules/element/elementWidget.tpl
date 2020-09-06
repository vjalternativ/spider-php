
<{$params.name} 
{if $params.attrs}
	{foreach from=$params.attrs item=item key=key} 
		{$key}="{$item}" 
	{/foreach}
{/if}
>

{if $params.dual}

{if $params.content}
{$params.content}
{/if} 
</{$params.name}>
{/if}