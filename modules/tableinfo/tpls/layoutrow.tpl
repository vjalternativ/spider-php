<div class="form-group {$viewtype}layout-formlayoutrow" >

<div class="row">

{if $meta.type=='row'}

<div class="col-md-3">
<div class="input-group">
<input type="hidden" name="param-type[]" value="row" />
<input type="hidden"   name="param-label[]" value="" />

<div class="input-group-addon" onclick="delelement(this)"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>
<div class="input-group-addon">
<select class="fields select-field" >
<option value="">Choose Field</option>
{foreach from=$fields key=fkey item=item}
<option value="{$fkey}">{$fkey}</option>
{/foreach}
</select>
</div>
<input class="form-control select-grid" type="number" min="1" max="12" value="6" />
<div class="input-group-addon" data-viewtype="{$viewtype}" onclick="addFieldLayout(this)"><i class="fa fa-plus text-primary" aria="hidden"></i></div></div>
</div>

<div class="col-md-8 border-left">


<div class="row layoutrow" >
{assign var="colcounter" value=0}
{foreach from=$meta.fields key=mkey item=fieldinfo}
<div  class="col-md-{$fieldinfo.gridsize} gridfield-{$viewtype}layout-form-layout-row-{$counter}">
<div class="input-group">
<div class="form-control">{$fieldinfo.field.name}<input type="hidden" name="layout-field-{$counter}[]" value="{$fieldinfo.field.name}" /> <input type="hidden" name="layout-gridsize-{$counter}[]" value="{$fieldinfo.gridsize}" /></div>
<div class="input-group-addon" onclick="deletecell(this)"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>
</div>
</div>
{assign var="colcounter" value=$colcounter+1}

{/foreach}
</div>
</div>
{elseif $meta.type=='hr'}

<div class="col-md-3"><input type="hidden" name="param-type[]" value="hr" /></div>
<div class="col-md-8 border-left">
<div class="input-group">
<input type="hidden" name="layout-field-{$counter}[]" value="hr" /> <input type="hidden" name="layout-gridsize-{$counter}[]" value="12" />
<input type="text"  class="form-control" name="param-label[]" value="{$meta.label}" />
<div class="input-group-addon">Horizontal Rule</div>
<div class="input-group-addon" onclick="delelement(this)"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>

</div>
</div>

{/if}

<div class="col-md-1"><a href="javascript:void(0);" onclick="orderup('container-{$viewtype}layout-form-layout-row-{$counter}')">UP</a> <a href="javascript:void(0);" onclick="orderdown('container-{$viewtype}layout-form-layout-row-{$counter}')">DW</a></div>
</div>
</div>