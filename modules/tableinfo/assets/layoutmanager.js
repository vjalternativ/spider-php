
function newdropdown() {
	
	$("#newdropdown-modal").modal();
	
}

function ajaxeditoption(key) {



var url = 'index.php?module=tableinfo&action=ajaxeditoption&list='+key;
$.post(url,{},function(response) {
					   
$("#basic-modal").modal();
$("#basic-modal-body").html(response);


});


}


function deleteoptionrow(counter) {

$("#opt-"+counter).remove();	
	
}

function newoptionrow() {

var count = $('.opt-row').length;

var url = 'index.php?module=tableinfo&action=ajaxnewoptionrow&count='+count;

$.post(url,{},function(response) {
					   
$("#opt-body").append(response);


});

	
}

// for dropdown view

function newlistoptionrow() {

var count = $('.opt-list-row').length;
var url = 'index.php?module=tableinfo&action=ajaxnewoptionrow&count='+count;

$.post(url,{},function(response) {					   
$("#opt-list-body").append(response);
});

	
}


$('#listviewlayouttable-body').sortable();

// for table info detail view list layout tab


function additemlistview(tableid) {
	
	var field = $("#"+tableid+'-fields').val();
	var count = $(".".tableid).length;
	var html = '<tr id="'+tableid+'-'+count+'" class="'+tableid+'-row"><td>'+field+'</td><td><input type="hidden" name="field[]" value="'+field+'" /><input type="hidden" name="colorder[]" /></td>';
	html +='<td><button onclick="delelement(\''+tableid+'-'+count+'\')" type="button" class="btn btn-danger">x</button></td></tr>';
	
	$("#"+tableid).append(html);
	
	
}

function savelistviewfields(id,view,form) {

var fields = $( '#'+form ).serializeArray();

var url = 'index.php?module=tableinfo&action=ajaxSaveListViewLayout&id='+id+'&view='+view;
$.post(url,fields,function(){
						   
console.log("done");						   
});
}

function additemeditview() {
	
	var field = $("#editviewfield").val();
	var html = '<tr><td>'+field+'<input type="hidden" name="label[]" value="" /><input type="hidden" name="type[]" value="field" />';
	html += '<input type="hidden" name="field[]" value="'+field+'" /></td><td><input type="text" name="order[]" value="" /></td>';
	html += '<td><input type="text" name="gridsize[]" value="" /></td><td>';
	html += '<button type="button" class="btn btn-danger">Delete</button></td></tr>';
	$("#tbody-editviewlayout").append(html);
	
	
}

function addextraitemeditview() {
	
	var field = $("#editviewextrafield").val();
	var html = '<tr><td>'+field+'<input type="text" name="label[]" placeholder="Label.." value="" /><input type="hidden" name="type[]" value="field" />';
	html += '<input type="hidden" name="field[]" value="'+field+'" /></td><td><input type="text" name="order[]" value="" /></td>';
	html += '<td><input type="text" name="gridsize[]" value="" /></td><td>';
	html += '<button type="button" class="btn btn-danger">Delete</button></td></tr>';
	$("#tbody-editviewlayout").append(html);
	
	
}

function delelement(id) {
$("#"+id).remove();	
}

function addFieldLayout(id,counter) {
	
 var field = $("#field-"+id).val();
 var grid = $("#grid-"+id).val();
 var count = $('.gridfield-'+id).length;
		
 var html = '<div class="col-md-'+grid+' gridfield-'+id+'" id="gridfield-'+id+'-'+count+'"><div class="input-group"><div class="form-control">'+field+' <input type="hidden" name="layout-field-'+counter+'[]" value="'+field+'" /> <input type="hidden" name="layout-gridsize-'+counter+'[]" value="'+grid+'" /></div><div class="input-group-addon" onclick="delelement(\'gridfield-'+id+'-'+count+'\')"><i class="fa fa-window-close text-danger" aria="hidden"></i></div></div></div>';
 $("#"+id).append(html);
}

function setParams(id) {
	
	var value = $("#"+id+'-params').val();
	var count = $('.'+id+'layoutrow').length;
		var html = '<div class="form-group '+id+'layoutrow"  id="container-'+id+'-layout-row-'+count+'"><div class="row">';
		
	if(value=='row') {
	var selecfieldshtml = $("#select_fields_field").html();	
	html += '<div class="col-md-3"><input type="hidden" name="param-type[]" value="row" /><input type="hidden"  name="param-label[]" value="" />';
	html += '<div class="input-group"><div class="input-group-addon" onclick="delelement(\'container-'+id+'-layout-row-'+count+'\')"><i class="fa fa-window-close text-danger" aria="hidden"></i></div><div class="input-group-addon"><select class="fields select-field" id="field-'+id+'-layout-row-'+count+'"  >'+selecfieldshtml+'<select></div><input class="form-control" id="grid-'+id+'-layout-row-'+count+'"  type="number" min="1" max="12" value="6"  /><div class="input-group-addon" onclick="addFieldLayout(\''+id+'-layout-row-'+count+'\',\''+count+'\')"><i class="fa fa-plus text-primary" aria="hidden"></i></div></div>';
		
		html += '</div>';
		html += '<div class="col-md-9 border-left" ><div class="row" id="'+id+'-layout-row-'+count+'"></div></div>';
	
	} else if(value=='hr') {
		
		html += '<div class="col-md-3"><input type="hidden" name="param-type[]" value="hr" /></div><div class="col-md-9 border-left"><div class="input-group">';
html += '<input type="hidden" name="layout-field[]" value="hr" /> <input type="hidden" name="layout-gridsize[]" value="12" />';		
html += '<input type="text"  class="form-control" name="param-label[]" Placeholder="Label" /><div class="input-group-addon">Horizontal Rule</div>';
html += '<div class="input-group-addon" onclick="delelement(\'container-'+id+'-layout-row-'+count+'\')"><i class="fa fa-window-close text-danger" aria="hidden"></i></div>';
html += '</div></div>';
		
	} else {
		return false;	
	}
	html += '</div></div>';
		
	$("#"+id).append(html);
	$(".fields").html($("#listviewfield").html());
	
}


function saveLayout(id,record,type) {
	
	var url = 'index.php?module=tableinfo&action=ajaxSaveLayout&type='+type+'&record='+record;
	var data = $("#"+type+"layout-form-tag").serializeArray();
	$.post(url,data,function(response) {
		console.log(response);						 
	});
}