
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


//$('#listviewlayouttable-body').sortable();

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


function deletecell(elem) {
	var e = $(elem).parent().parent();
	$(e).remove();
}

function delelement(id) {
$("#"+id).remove();	
}

function addFieldLayout(elem) {
	
	var field = $(elem).parent().find(".select-field").val();
	var grid = $(elem).parent().parent().find(".select-grid").val();
		
	var html = '<div class="col-md-'+grid+' gridfield" ><div class="input-group"><div class="form-control">'+field+' <input type="hidden" name="layout-field[]" value="'+field+'" /> <input type="hidden" name="layout-gridsize[]" value="'+grid+'" /></div><div class="input-group-addon" onclick="deletecell(this)"><i class="fa fa-window-close text-danger" aria="hidden"></i></div></div></div>';
	$(elem).parent().parent().next().find(".layoutrow").append(html);
}

function setParams(elem) {
	
	var value = $(elem).parent().find(".layout-form-params").val();
	var viewtype = $(elem).parent().find(".layout-view-type").val();
	var rmodule = $(elem).parent().find(".layout-view-rmoudle").val();
	
	var dropdown = $(elem).parent().find(".select_fields_field").html();
	if(value !="") {
		$.post(fwbaseurl+"index.php?module=tableinfo&action=ajaxAddlayoutrow",{rmodule:rmodule,rowtype:value,viewtype:viewtype},function(html){
			$("#"+viewtype+"-layout-form").append(html);
			$(".fields").html(dropdown);
				
		});
	}
	
	
		
	
}


function addrowbelow(elem) {
	var viewtype = $(elem).data("viewtype");
	var value = $("#"+viewtype+"layout-form-params").val();
	var rmodule = $("#"+viewtype+"-layout-view-rmoudle").val();
	var dropdown = $("#"+viewtype+"-select-fields-field").html();
	if(value !="") {
		$.post(fwbaseurl+"index.php?module=tableinfo&action=ajaxAddlayoutrow",{rmodule:rmodule,rowtype:value,viewtype:viewtype},function(html){
			$(elem).parent().parent().parent().parent().after(html);
			$(".fields").html(dropdown);
				
		});		
	}
	
}


function delrow(elem) {
	$(elem).parent().parent().parent().parent().remove();
}


function saveLayout(id,record,type) {
	
	var url = 'index.php?module=tableinfo&action=ajaxSaveLayout&type='+type+'&record='+record;
	var data = $("#"+type+"layout-form-tag").serializeArray();
	$.post(url,data,function(response) {
		console.log(response);						 
	});
}

function orderup(elem) {
	var ele = $(elem).parent().parent().parent();
	var prev = ele.prev();
	prev.before(ele);
}
function orderdown(elem) {
	var ele = $(elem).parent().parent().parent();
	var next = ele.next();
	next.after(ele);
}