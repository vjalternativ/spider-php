<div id="version" data-id="{$version}"></div>
<div class="form-group margin-top-10">

<div class="row">


<div class="col-md-4">
<div class="input-group">
<select name="editviewparam" id="{$viewtype}layout-form-params" class="form-control layout-form-params">
<option value="">Choose Param</option>
{foreach from=$layout_param_list key=key item=item}

<option value="{$key}">{$item}</option>
{/foreach}
</select>

<select class="hide select_fields_field">
<option value="">Choose Field</option>
{foreach from=$fields key=fkey item=item}
<option value="{$fkey}">{$fkey}</option>
{/foreach}
</select>


<input type="hidden" class="layout-view-rmoudle" value="{$rmodule}" />
<input type="hidden" class="layout-view-type" value="{$viewtype}" />
<div class="input-group-addon"  onclick="setParams(this)">
Add
</div>
</div>

</div>


</div>
</div>

<hr />
<form id="{$viewtype}layout-form-tag" action="index.php?module=tableinfo&action=saveLayout&type={$viewtype}">

<div class="row">
<div class="col-md-12" id="{$viewtype}-layout-form">
{assign var="counter" value=0}
{foreach from=$metadata key=key item=meta}



{assign var="path" value=$fwbasepath|cat:"modules/tableinfo/tpls/layoutrow.tpl"}
{include file=$path}


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
