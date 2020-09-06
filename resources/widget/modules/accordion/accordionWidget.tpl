<div id="accord_{$params.id}" class="mb-2">
    <div class="card rounded-0">
      <div class="card-header" data-toggle="collapse" href="#accord_{$params.id}_collapse">
        <a href="javascript:" class="card-link" >
         	{$params.header}
        </a>
      </div>
      <div id="accord_{$params.id}_collapse" class="collapse {if $params.seq_index==0} show {/if}" data-parent="#accord_{$params.id}">
        <div class="card-body">
        {$params.body}
        </div>
      </div>
     </div>
   
    
</div>