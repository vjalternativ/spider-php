
<div class="form-group margin-top-10">

<div class="row">


<div class="col-md-4">
<div class="input-group">
<select name="editviewparam" id="{$viewtype}layout-form-params" class="form-control">
<option value="">Choose Param</option>
{foreach from=$layout_param_list key=key item=item}

<option value="{$key}">{$item}</option>
{/foreach}
</select>

<select class="hide" id="select_fields_field">
<option value="">Choose Field</option>
{foreach from=$fields key=fkey item=item}
<option value="{$fkey}">{$fkey}</option>
{/foreach}
</select>

<div class="input-group-addon"  onclick="setParams('{$viewtype}layout-form')">
Add
</div>
</div>

</div>


</div>
</div>

<hr />
<form id="{$viewtype}layout-form-tag" action="index.php?module=tableinfo&action=saveLayout&type={$viewtype}">

<div class="row">
<div class="col-md-12" id="{$viewtype}layout-form">
{assign var="counter" value=0}
{foreach from=$metadata key=key item=meta}
<div class="form-group {$viewtype}layout-formlayoutrow" id="container-{$viewtype}layout-form-layout-row-{$counter}">
<div class="row">

{if $meta.type=='row'}

<div class="col-md-3">
<div class="input-group">
<input type="hidden" name="param-type[]" value="row" />
<input type="hidden"   name="param-label[]" value="" />

<div class="input-group-addon" onclick="delelement('container-{$viewtype}layout-form-layout-row-{$counter}')"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>
<div class="input-group-addon">
<select class="fields select-field" id="field-{$viewtype}layout-form-layout-row-{$counter}">
<option value="">Choose Field</option>
{foreach from=$fields key=fkey item=item}
<option value="{$fkey}">{$fkey}</option>
{/foreach}
</select>
</div>
<input class="form-control" id="grid-{$viewtype}layout-form-layout-row-{$counter}" type="number" min="1" max="12" value="6" />
<div class="input-group-addon" onclick="addFieldLayout('{$viewtype}layout-form-layout-row-{$counter}','{$counter}')"><i class="fa fa-plus text-primary" aria="hidden"></i></div></div>
</div>

<div class="col-md-9 border-left">

<div class="row" id="{$viewtype}layout-form-layout-row-{$counter}">
{assign var="colcounter" value=0}
{foreach from=$meta.fields key=mkey item=fieldinfo}
<div id="gridfield-{$viewtype}layout-form-layout-row-{$counter}-{$colcounter}" class="col-md-{$fieldinfo.gridsize} gridfield-{$viewtype}layout-form-layout-row-{$counter}">
<div class="input-group">
<div class="form-control">{$fieldinfo.field.name}<input type="hidden" name="layout-field-{$counter}[]" value="{$fieldinfo.field.name}" /> <input type="hidden" name="layout-gridsize-{$counter}[]" value="{$fieldinfo.gridsize}" /></div>
<div class="input-group-addon" onclick="delelement('gridfield-{$viewtype}layout-form-layout-row-{$counter}-{$colcounter}')"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>
</div>
</div>
{assign var="colcounter" value=$colcounter+1}

{/foreach}
</div>
</div>
{elseif $meta.type=='hr'}

<div class="col-md-3"><input type="hidden" name="param-type[]" value="hr" /></div>
<div class="col-md-9 border-left">
<div class="input-group">
<input type="hidden" name="layout-field-{$counter}[]" value="hr" /> <input type="hidden" name="layout-gridsize-{$counter}[]" value="12" />
<input type="text"  class="form-control" name="param-label[]" value="{$meta.label}" />
<div class="input-group-addon">Horizontal Rule</div>
<div class="input-group-addon" onclick="delelement('container-{$viewtype}layout-form-layout-row-{$counter}')"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>

</div>
</div>

{/if}


</div>
</div>
{assign var="counter" value=$counter+1}
{/foreach}
</div>
</div>

<div class="row">
<div class="col-md-12">
<hr />
<button type="button" onclick="saveLayout('','{$record}','{$viewtype}')" class="btn btn-primary pull-right">Save</button>
<div class="clearfix"></div>

</div>
</div>
</form>
