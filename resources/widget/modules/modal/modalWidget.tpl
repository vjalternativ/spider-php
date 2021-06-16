<!-- The Modal -->
<div class="modal" id="{$params.id}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="{$params.id}_form" method="post" enctype="multipart/form-data">
				<!-- Modal Header -->
				<div class="modal-header bg-info">
					<h4 class="modal-title">{$params.title}</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">{$params.body}</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-right"
						data-dismiss="modal">Close</button>
				       
							{$params.footer}
							
							<div class="clearfix"></div>
		
				</div>
			</form>
		</div>
	</div>
</div>