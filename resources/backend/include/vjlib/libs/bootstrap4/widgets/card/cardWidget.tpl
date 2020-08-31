<div class="card">
{if $params.header}
<div class="card-header {if $params.headerclass} {$params.headerclass} {/if}">

 {$params.header}
</div>
{/if}

{if $params.body}
<div class="card-body">
{$params.body}
</div>
{/if}
{if $params.footer}
<div class="card-footer">
{$params.footer}

</div>
{/if}
</div>