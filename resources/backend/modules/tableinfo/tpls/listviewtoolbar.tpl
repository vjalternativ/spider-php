{if $showstatus}
<div class="alert alert-{$reqresp.status}">
  <strong>Message!</strong> {$reqresp.message}
	{if $reqresp.status=="sucess" && $reqresp.data}
		
		{foreach from=$reqresp.data item=item key=key}
				<p>Failed to import data : {$key} : {$item}</p>
				{/foreach}
	{/if}  
</div>
{/if}
<div class="well well-sm">
<div class="row">
	<div class="col-md-12">
				<button class="btn btn-info" data-toggle="modal" data-target="#genericmodal_importdata">Import</button>
				
				<button class="btn btn-info" data-toggle="modal" data-target="#genericmodal_importbottomdescdata">Import Bottom Desc</button>
				<div class="clearfix"></div>
	</div>
</div>
</div>


{$importmodalhtml}

{$importbotdescmodalhtml}



<div id="files" class="files" style="display:none"></div>
<script src="modules/chunkuploader/js/vendor/jquery.ui.widget.js"></script>
<script src="modules/chunkuploader/js/jquery.fileupload.js"></script>

{literal}
<script src="modules/tableinfo/assets/fileuploader.js?v=1"></script>

{/literal}