
<div id="genericmodal_{$modal->id}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

<form id="genericmodal_{$modal->id}-form" method="post" {if $modal->formaction} action="{$modal->formaction}" {/if} enctype="multipart/form-data" >
   
      <div class="modal-header bg-info">
      	<span class="h3 heading">{$modal->heading}</span>
      	{$modal->extraheader}
      	
      	 <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      {if $modal->afterheader}
      <div class="modal-header">
       
      
	  {$modal->afterheader}
	  
	  
	  
	  
	  
	 	
		
	  
	  </div>
	  
	  {/if}
      <div class="modal-body" id="genericmodal_{$modal->id}-body">
        
		{if $modal->body}
		{$modal->body}
		{/if}
		
      </div>
      <div class="modal-footer">
      	{$modal->extrafooter}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>