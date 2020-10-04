
$(document).ready(function(){
	$("#page").on('change', function() {
		  
		
		var url = "index.php?module=widget&action=ajaxGetPositions";
		$.post(url,{page:this.value},function(res){
			
			$("#position").html(res);
			
		});
		
	});
	
	CKEDITOR.replace( 'editor' );
	
});
;
