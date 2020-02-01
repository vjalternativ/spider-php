<div id="newrelationshipmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
	 {literal} 
	 <script>
	 function  rtypechange(value) {
	 	return;
		$("#rname-row").addClass('hide');
		$("#lhsrelfield").addClass('hide');
		$("#rhsrelfield").addClass('hide');
		
		
		
		
	 	if(value=='1_M') {
				$("#rhsrelfield").removeClass('hide');
		} else if(value=='M_1') {
				$("#lhsrelfield").removeClass('hide');
		} else {
				$("#rhsrelfield").removeClass('hide');
				$("#lhsrelfield").removeClass('hide');
		}
		$("#rname-row").removeClass('hide');
		
	 }
	 </script> 
	 {/literal}
	  <form method="post" action="index.php?module=tableinfo&action=saverelationship&record={$record}&primarymod={$primarytable}">
	  
	  <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Relationship</h4>
      </div>
      <div class="modal-body">
	  
	  
      <div class="form-group">
	  
	  <div class="row">
	  <div class="col-md-4">
	  <span class="form-control">{$primarytable}</span>
	  </div>
	 
	  <div class="col-md-3">
	  <select name="rtype" class="form-control" onchange="rtypechange(this.value)">
	 	<option value="1_M">One to Many</option>
		<option value="M_1">Many to One</option>
		<option value="M_M">Many to Many</option>
	 	<option value="cstm">Custom</option>
	 </select>
	  </div>
	 <div class="col-md-5">
	  <select name="secondarytable" class="form-control">
	  {foreach from=$tables key=key item=item}
	  <option value="{$key}">{$item.name}</option>
	  {/foreach}
	  </select>
	  </div>
	  </div>
	  
	  </div>
      <div class="form-group">
	  <div id="rname-row" class="row">
	  	<div  class="col-md-6">
		<input id="lhsrelfield"  type="text" class="form-control" name="lhs_module_rname" placeholder="Relationship Name" />		
		</div>
		<div  class="col-md-6">
		<input id="rhsrelfield"  type="text" class="form-control" name="rhs_module_rname" placeholder="Relationship Name" />		
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
