<nav>
    <ol class="breadcrumb">
       	{foreach from=$params item=data}
        <li class="breadcrumb-item {if $data.islast}active{/if}">
        {if !$data.islast}
        <a href="{$data.link}">
        {/if}
        {$data.title}
        {if !$data.islast}
        </a>
        {/if}
        
        </li>
        {/foreach}
    </ol>
</nav>
