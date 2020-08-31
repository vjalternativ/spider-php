<nav aria-label="...">
  <ul class="pagination pull-right">
    <li class="page-item {if $pageinfo.activepage==1}disabled{/if}">
      <a class="page-link" {if $ajaxMode} onclick="ajaxGetPagination('{$pageinfo.url}','{$pageinfo.container_id}','{$pageinfo.record}','{$pageinfo.prev}')" {/if}   {if $ajaxMode} href="javascript:" {else} href="{$pageinfo.prevurl}" {/if} tabindex="-1">Previous</a>
    </li>
    
    {foreach from=$pageinfo.pagelist key=key item=val}
    <li class="page-item {if $pageinfo.activepage==$val}active{/if}" {if $ajaxMode} onclick="ajaxGetPagination('{$pageinfo.url}','{$pageinfo.container_id}','{$pageinfo.record}','{$val}')" {/if}><a class="page-link" {if $ajaxMode} href="javascript:" {else} href="{$pageinfo.url}{$val}" {/if}>{$val}</a></li>
    {/foreach}
    
    <li class="page-item {if $pageinfo.nexturl=='#'}disabled{/if}">
      <a   class="page-link"  {if $ajaxMode} onclick="ajaxGetPagination('{$pageinfo.url}','{$pageinfo.container_id}','{$pageinfo.record}','{$pageinfo.next}')" {/if}   {if $ajaxMode} href="javascript:" {else}  href="{$pageinfo.nexturl}" {/if}>Next</a>
    </li>
  </ul>
<div class="clearfix"></div>
</nav>