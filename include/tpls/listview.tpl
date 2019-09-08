<div class="panel panel-info">
<div class="panel-heading">
<span class="h3">{$module} : Manager</span>
{$addnew}
<div class="clearfix"></div>


</div>
<div class="panel-body">
<form method="post">
{assign var=counter value=0}
{foreach from=$filters key=key item=filter}
{assign var=counter value=$counter+1}
{if $counter==1}
<div class="form-group">
<div class="row">
{/if}

<div class="col-md-3">
{if $filter.type=='varchar'}
{include file='include/tpls/filters/varchar.tpl'}
{/if}

</div>


{if $counter==4}
</div>
</div>
{assign var=counter value=0}
{/if}
{/foreach}

{if $counter!=0}
</div>
</div>
{/if}

<div class="row form-group">
<div class="col-md-6">
<button type="submit" name="listfilter" class="btn btn-primary">Search</button>
<button type="reset" class="btn btn-default">Reset</button>

</div>


</div>
</form>

{$table}


{$pagingHtml}



</div>

</div>

