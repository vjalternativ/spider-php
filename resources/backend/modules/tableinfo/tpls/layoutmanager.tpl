<link rel="stylesheet" href="{$fwbaseurl}resources/backend/modules/tableinfo/assets/layoutmanager.css" />
<div id="newfieldmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
	  <form method="post" action="index.php?module=tableinfo&action=addfield">
	  <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Field</h4>
      </div>
      <div class="modal-body">
	  
	  
      <div class="form-group">
	  
	  <div class="row">
	  <div class="col-md-6">
	  <input type="hidden" name="tableinfo-id" value="{$record}" />
	  <input type="hidden" name="tableinfo-name" value="{$primarytable}" />
	  <input type="hidden" id="formodule" name="formodule" value="{$formodule}" />
	  <input type="hidden" id="formodulerecord" name="formodulerecord" value="{$formodulerecord}" />
	   
	  <input type="text" name="field-name" id="field-name" class="form-control" placeholder="Field Name" />
	  </div>
	 
	 
	  <div class="col-md-6">
	  <select name="field-type" id="field-type" class="form-control" >
	  <option value="varchar">Varchar</option>
	  <option value="text">Textarea</option>
	  <option value="enum">Dropdown</option>
	  <option value="datetime">Datetime</option>
	  <option value="date">Date</option>
	  <option value="int">Int</option>
	  <option value="float">Float</option>
	  <option value="relate">Relate</option>
	  <option value="dependent_relate">Dependent Relate</option>
	  <option value="file">File</option>
	  <option value="checkbox">Checkbox</option>
	  <option value="multienum">Multiselect</option>
	  </select>
	  </div>
	 
	  </div>
	  
	   </div>
	   
	   <div class="form-group">
	  <div class="row">
	  <div class="col-md-6">
	  <input type="text" name="field-len" id="field-len" class="form-control" placeholder="Field-Length" />
	 
	 </div>
	 <div class="col-md-6">
	  <input type="text" name="field-default" id="field-default" class="form-control" placeholder="Default" />
	 
	 </div>
	  </div> 
	   </div>
	  
	 <div class="form-group">
	  <div class="row">
	  <div class="col-md-6">
	  <input type="text" name="field-label" id="field-label" class="form-control" placeholder="Field-Label" />
	 
	 </div>
	 <div class="col-md-6">
	 <select name="field-notnull" id="field-notnull" class="form-control">
	  <option value="false">--Not Null--</option>
	  <option value="false">False</option>
	  <option value="true">True</option>
	  </select>
	 
	 </div>
	  </div> 
	   </div>
      
	  <div class="form-group">
	  <div class="row">
	 
	 <div class="col-md-6">
			 <select name="field-options" id="field-options" class="form-control">
			 <option value="">OPTION NA</option>
				 {foreach from=$dropdowns key=id item=dropdown}
				 
				 <option value="{$id}">{$id}</option>
				 {/foreach}
			</select>
			 
	 </div>
	 <div class="col-md-6">
	 	<select name="field-table" class="form-control">
	 		<option value="">-Custom NA-</option>
	 		<option value="cstm">Custom</option>
	 	</select>
	 </div>
	 
	  </div> 
	  
	  
	   </div>
	  
	  <div class="form-group">
	  	<div class="row">
	  		<div class="col-md-6">
	  			<select class="form-control" name="rmodule">
	  				<option value="">Relate Module</option>
	  				{foreach from=$tables key=key item=row} 
	  					<option value="{$row.name}">{$row.label}</option>
	  				{/foreach}
	  			</select>
	  		</div>
	  		<div class="col-md-6">
	  			<select class="form-control" name="dependent_relate_field">
	  				<option value="">Dependent Relate Field</option>
	  				{foreach from=$fields key=key item=row} 
	  					<option value="{$key}">{$key}</option>
	  				{/foreach}
	  			</select>

	  		</div>
	  	</div>
	  </div>
	  
	  
	  	  <div class="form-group">
	  	<div class="row">
	  		<div class="col-md-6">
	  			<select class="form-control" name="relate_relationship">
	  				<option value="">Relate Relationship</option>
	  				{foreach from=$global_relationship_list key=key item=row} 
	  					<option value="{$key}">{$key}</option>
	  				{/foreach}
	  			</select>
	  		</div>
	  		<div class="col-md-6">
	  				<select class="form-control" name="field_index">
	  				<option value="">Field Index</option>
	  				<option value="unique">Unique</option>
	  				</select>	
	  		</div>
	  	</div>
	  </div>
	  
	  
	  
	  
	  </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
	  
	  
	  
    </div>

  </div>
</div>

<div id="dropdowneditormodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
	  <div class="panel panel-info">
	  <div class="panel-heading"></div>
	  </div>
	  
	  
	
	  
	  
	  
	  
	  
    </div>

  </div>
</div>

{include file=$relationshipmodal}





