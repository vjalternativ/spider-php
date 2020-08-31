<table border="1"  cellspacing="0" cellpadding="0" width="100%">

	{foreach from=$rows key=rkey item=row}
		<tr>
		
		{foreach from=$row key=ckey item=cell}
			<td><b>{$cell.heading}</b></td>
			<td>{$cell.value}</td>
		{/foreach}
		
		</tr>
			
	{/foreach}


</table>