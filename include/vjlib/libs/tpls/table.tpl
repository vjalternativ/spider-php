{if $headers}
<table class="table table-striped table-bordered">

	<thead>
		<tr>
		
		{foreach from=$extraPreFields key=key item=item}
			<th>{$item.header.html}</th>
		{/foreach}
		{foreach from=$headers key=key item=item}
			<th>{$item.label}</th>
		{/foreach}
		{foreach from=$extraPostFields key=key item=item}
			<th>{$item.header.html}</th>
		{/foreach}
	
		</tr>
	</thead>
	
	<tbody>
{/if}
	
	
	{foreach from=$rows key=key item=row}
		<tr id="trow-{$key}">
			{foreach from=$extraPreFields key=ekey item=item}
				<td>{$item.data.html|replace:'REPLACE_KEY':$key}</td>
			{/foreach}
			{foreach from=$headers key=hkey item=item}
				<td>{$row[$hkey]}</td>
			{/foreach}
			
			{foreach from=$extraPostFields ekey=key item=item}
				<td>{$item.data.html|replace:'REPLACE_KEY':$key}</td>
			{/foreach}
			
		</tr>	
	{/foreach}
	
{if $headers}
	</tbody>
</table>
{/if}