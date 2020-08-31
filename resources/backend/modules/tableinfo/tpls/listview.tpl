<form id="{$tbid}-form" method="post">
<div class="form-group margin-top-10">

<div class="row">
<div class="col-md-4">
<div class="input-group">
<select name="listviewfield" id="{$tbid}-fields" class="form-control">
<option value="">Choose Field</option>
{foreach from=$fields key=key item=item}

<option value="{$key}">{$key}</option>
{/foreach}
</select>
<div class="input-group-addon bg-primary" onclick="additemlistview('{$tbid}')">
Add
</div>
</div>

</div>

</div>

<hr />


{$table}

<button type="button" onclick="savelistviewfields('{$record}','{$view}','{$tbid}-form')" class="btn btn-primary pull-right">Save</button>
<div class="clearfix"></div>
</div>

</form>