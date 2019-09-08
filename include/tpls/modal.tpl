<div id="basic-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	{if $isform}
	<form method="post" action="{$url}" enctype="multipart/form-data">
    {/if}
	  <div class="modal-header bg-{$class}">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
		
		
		<h4 class="modal-title">{$heading}</h4>
      </div>
      <div class="modal-body" id="basic-modal-body">
     	{$body}
      </div>
      <div class="modal-footer">
	  	{$footbutton}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  {if $isform}
		</form>
	{/if}
	  
    </div>

  </div>
</div>