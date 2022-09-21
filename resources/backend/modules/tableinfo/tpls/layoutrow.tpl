<div class="form-group {$viewtype}layout-formlayoutrow" >

<div class="row">
{if $meta.type=='row'}

<div class="col-md-4">
<div class="input-group">
<input type="hidden" name="param-type[]" value="row" />
<input type="hidden"   name="param-label[]" value="" />
<div class="input-group-addon" data-viewtype="{$viewtype}" onclick="addrowbelow(this)">
<i class="fa fa-plus text-primary" aria="hidden"></i>
</div>
<div class="input-group-addon" onclick="delrow(this)">
<i class="fa fa-window-close text-danger" aria="hidden"></i>
</div>
<div class="input-group-addon">
<select class="fields select-field" >
<option value="">Choose Field</option>
{foreach from=$fields key=fkey item=item}
<option value="{$fkey}">{$fkey}</option>
{/foreach}
</select>
</div>

<input class="form-control select-grid" type="number" min="1" max="12" value="6" />
<div class="input-group-addon" data-viewtype="{$viewtype}" onclick="addFieldLayout(this)">
<i class="fa fa-plus text-primary" aria="hidden"></i>
</div>
</div>
</div>

<div class="col-md-7 border-left">


<div class="row layoutrow" >
{assign var="colcounter" value=0}
{foreach from=$meta.fields key=mkey item=fieldinfo}
<div  class="col-md-{$fieldinfo.gridsize} gridfield-{$viewtype}layout-form-layout-row">
<div class="input-group">
<div class="form-control">
{$fieldinfo.field.name}
<input type="hidden" name="layout-field-type[]" value="{if $colcounter==0}row{/if}" /> 
<input type="hidden" name="layout-field[]" value="{$fieldinfo.field.name}" /> 
<input type="hidden" name="layout-gridsize[]" value="{$fieldinfo.gridsize}" />
<input type="hidden" name="layout-field-label[]" value="" />
</div>
<div class="input-group-addon">
<input name="layout-{$fieldinfo.field.name}-isreq" value='1' type="checkbox"  {if isset($fieldinfo.r)} checked="checked" {/if} /> R
</div>
<div class="input-group-addon" onclick="deletecell(this)"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>
</div>
</div>
{assign var="colcounter" value=$colcounter+1}

{/foreach}
</div>
</div>
{elseif $meta.type=='hr'}

<div class="col-md-4">
	<input type="hidden" name="param-type[]" value="hr" />
</div>
<div class="col-md-7 border-left">
<div class="input-group">
<input type="hidden" name="layout-field-type[]" value="hr" /> 
<input type="hidden" name="layout-field[]" value="hr" /> 
<input type="hidden" name="layout-gridsize[]" value="12" />
<input type="text"  class="form-control" name="layout-field-label[]" value="{$meta.label}" />


<div class="input-group-addon">Horizontal Rule</div>
<div class="input-group-addon" onclick="deletecell(this)">
<i class="fa fa-window-close text-danger" aria="hidden"></i>
</div>

</div>
</div>

{/if}

<div class="col-md-1">
<a href="javascript:void(0);" onclick="orderup(this)">
<i class="fa fa-arrow-up text-primary" aria="hidden"></i>
</a> 
<a href="javascript:void(0);" onclick="orderdown(this)">
<i class="fa fa-arrow-down text-primary" aria="hidden"></i>
</a>
</div>
</div>
</div>