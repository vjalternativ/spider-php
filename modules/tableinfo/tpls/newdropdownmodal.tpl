<div id="newdropdown-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	<form method="post" action="index.php?module=tableinfo&action=saveoption" enctype="multipart/form-data">
      <div class="modal-header bg-{$class}">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
  	<h4 class="modal-title">New Dropdown</h4>
      </div>
      <div class="modal-body" id="basic-modal-body">
  	<div class="form-group">
		<div class="row">
		<div class="col-md-6">
			<input class="form-control" type="text" name="list" placeholder="Name.." />
	
		</div>
		</div>
	</div>
		
		
		<table class="table table-striped">
		<thead>
		<tr>
		<th>Key</th><th>Value</th><th>Action</th>
		</tr>
		</thead>
		<tbody id="opt-list-body">
		<tr class="opt-list-row" id="opt-list-row-0">
		<td><input class="form-control" type="text" name="key[]" /></td>
		<td><input class="form-control" type="text" name="val[]" /></td>
		<td>
		<button class="btn btn-primary btn-sm" type="button" onclick="newlistoptionrow()">+</button>
		<button class="btn btn-danger btn-sm" type="button">x</button>
		</td>
		</tr>
		
		</tbody>
		</table>
		
		
      </div>
      <div class="modal-footer">
	  	{$footbutton}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	 	</form>
	  
    </div>

  </div>
</div>