<table class="table table-striped">

{foreach from=$params.rows item=row}
<tr>
	{foreach from=$row item=col}
		<td>{$col}</td>
	{/foreach}

</tr>
{/foreach}
	
</table>