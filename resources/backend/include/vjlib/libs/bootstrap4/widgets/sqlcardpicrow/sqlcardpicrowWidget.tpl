{if $params.widget}
{$params.widget}

{else}
{foreach from=$params item=param}

{$param.widget}

{/foreach}

{/if}