



function showDatePicker(ele) {
	$(ele).datetimepicker({
        format: 'YYYY-MM-DD'
    });
}

function deleteRecord(element,module,id) {
var x = confirm("Are you sure?");
if(!x) {
return false;	
}
var url = "./index.php?module=tableinfo&action=deleteRecord&mod="+module+"&id="+id;
$.post(url,{},function(response){
	$("#"+element).remove();
});

}

function processFieldType(fieldType,optionId) {

if(fieldtype=='enum') {
	
	
	
	
	
}



}



var RELATE_MODULE = "";
var RELATE_VALUE ="";
var RELATE_FIELD ="";
var RELATE_PARENT_ID = "";
var RELATE_RELATIONSHIP = "";
function modalRelateModule(value) {
	RELATE_VALUE = value;
   var url = "./index.php?module=tableinfo&action=ajaxrelatemodal&rmodule="+RELATE_MODULE+"&value="+RELATE_VALUE+'&field='+RELATE_FIELD;
	if(RELATE_RELATIONSHIP !="" && RELATE_PARENT_ID!="") {
		url += "&parent_id="+RELATE_PARENT_ID+"&relate_relationship="+RELATE_RELATIONSHIP;
	
	}
	
	$.post(url,{},function(result){
		$("#rmodal-body").html(result);
	});

}

function dependentRelatemodule(relate_relationship,dependent_relate_field,rmodule,value,field) {
		var parentId = $("#"+dependent_relate_field).val();
		RELATE_MODULE = rmodule;
		RELATE_VALUE = value;
		RELATE_FIELD = field;
		RELATE_PARENT_ID = parentId;
		RELATE_RELATIONSHIP = relate_relationship;
		if(RELATE_VALUE.length<1) {
		return true;	
		}

	var url = "./index.php?module=tableinfo&action=ajaxrelatemodal&rmodule="+RELATE_MODULE+"&value="+RELATE_VALUE+'&field='+RELATE_FIELD;
	url += "&parent_id="+parentId+"&relate_relationship="+relate_relationship+"&dependent_relate_field="+dependent_relate_field;
	$.post(url,{},function(result){
		$("#rmodal-body").html(result);
		$("#relatemodal").modal();
		
	});
		

}

function relatemodule(rmodule,value,field) {

RELATE_MODULE = rmodule;
RELATE_VALUE = value;
RELATE_FIELD = field;
RELATE_PARENT_ID = "";
RELATE_RELATIONSHIP = "";
if(RELATE_VALUE.length<1) {
return true;	
}

var url = "./index.php?module=tableinfo&action=ajaxrelatemodal&rmodule="+RELATE_MODULE+"&value="+RELATE_VALUE+'&field='+RELATE_FIELD;
	$.post(url,{},function(result){
		$("#rmodal-body").html(result);
		$("#relatemodal").modal();
		
	});

}


function setrelate(field) {
	$("#"+field).val($("input.relate_field_id:checked").val());
	$("#"+field+"_name").val($("input.relate_field_id:checked").data('relate-name'));
}



function selectSubpanelItems(id) {

	var rtable = $("#subpanel_rtable-"+id).val();
	var relname = $("#subpanel_relname-"+id).val();
	var parentModule = $("#subpanel_"+id+"_parent_module").val();
	var parentId = $("#subpanel_"+id+"_parent_id").val();
	var parentRecord = $("#subpanel_"+id+"_parent_record").val();
	var primaryModule = $("#subpanel_ptable-"+id).val();
	var url = "./index.php?module=tableinfo&action=ajaxFetchSubpanleList&rtable="+rtable+"&relname="+relname+"&parent_module="+parentModule+"&parent_id="+parentId+"&parent_record="+parentRecord;
	$.post(url,{},function(result) {
			$("#genericmodal_subpanel-form").attr("action","index.php?module="+primaryModule+"&action=addSubpanelRelationship&record="+parentRecord+"&primaryModule="+primaryModule);
			$("#genericmodal_subpanel-body").html(result);
			$("#genericmodal_subpanel").modal("show");
	});
}



function  removeRelationship(record,relName,relId) {
	var x  = confirm("Are you sure to delete this record ?");
	if(x) {
		var url = "./index.php?module=tableinfo&action=ajaxRemoveRelationship&record="+record+"&relname="+relName+"&relid="+relId;
		$.post(url,{},function(result) {
				$("#trow-"+relId).remove();
		});	
	}
	
}


function ajaxGetPagination(url,id,record,page) {
	
	var ptable = $("#subpanel_ptable-"+id).val();
	var relname = $("#subpanel_relname-"+id).val();
	
	var data = {"ptable":ptable,"relname":relname,"record":record,"page":page,"container_id":id};
	$.post(url,data,function(result){
			$("#subpanel_"+id+ " .panel-body").html(result);
			if(typeof MathJax !== 'undefined') {MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
	});
	
}

$(document).ready(function(){

	  $('.datepicker').datetimepicker({
	        format: 'YYYY-MM-DD'
	    });
	  
	  $('.datetimepicker').datetimepicker({
	      format: 'YYYY-MM-DD H:m'
	  });
	  
	  let mathElements = [
        'math',
        'maction',
        'maligngroup',
        'malignmark',
        'menclose',
        'merror',
        'mfenced',
        'mfrac',
        'mglyph',
        'mi',
        'mlabeledtr',
        'mlongdiv',
        'mmultiscripts',
        'mn',
        'mo',
        'mover',
        'mpadded',
        'mphantom',
        'mroot',
        'mrow',
        'ms',
        'mscarries',
        'mscarry',
        'msgroup',
        'msline',
        'mspace',
        'msqrt',
        'msrow',
        'mstack',
        'mstyle',
        'msub',
        'msup',
        'msubsup',
        'mtable',
        'mtd',
        'mtext',
        'mtr',
        'munder',
        'munderover',
        'semantics',
        'annotation',
        'annotation-xml'
    ];
	  
	  
		$(".editor").each(function(){
			
				CKEDITOR.replace( this , {
					extraAllowedContent: mathElements.join( ' ' ) + '(*)[*]{*};img[data-mathml,data-custom-editor,role](Wirisformula)'
				});	
			
	}); 
	

});


function removeAttachment(module,record,field,id) {
	var x = confirm("Are you sure?");
	if(!x) {
	return false;	
	}
	
	var url = "index.php?module="+module+"&action=removeAttachment&record="+record+"&fieldname="+field+"&id="+id;
	$.post(url,{},function(res){
		window.location.reload();
	});
}