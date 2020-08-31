function nextTab(id) {

	
	if($("#"+id).next().length==1) {
	
		$("#"+id).addClass("fade");
		$("#"+id).removeClass("active");
		$("#"+id).next().removeClass("fade");
		$("#"+id).next().addClass("active");
		$("#"+id+"-link").children().removeClass("active");
		$("#"+id+"-link").next().children().addClass("active");
		
	}
}

function prevTab(id) {

	
	if($("#"+id).prev().length==1) {
	
		$("#"+id).addClass("fade");
		$("#"+id).removeClass("active");
		$("#"+id).prev().removeClass("fade");
		$("#"+id).prev().addClass("active");
		
		$("#"+id+"-link").children().removeClass("active");
		$("#"+id+"-link").prev().children().addClass("active");
	
	}
}