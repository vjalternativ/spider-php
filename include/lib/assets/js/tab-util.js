function nextTab(suffix) {

	
	var id = "tab-pane-"+suffix;
	
	if($("#"+id).next().length==1) {
	
		$("#"+id).addClass("fade");
		$("#"+id).removeClass("active");
		$("#"+id).next().removeClass("fade");
		$("#"+id).next().addClass("active");
		$("#"+id+"-link").children().removeClass("active");
		$("#"+id+"-link").next().children().addClass("active");
		var navlink = "nav-item-"+suffix;
		$("#"+navlink+ " > a").removeClass("active");
		$("#"+navlink).next().children().addClass("active");
		
	}
}

function prevTab(suffix) {

	var id = "tab-pane-"+suffix;
	
	if($("#"+id).prev().length==1) {
	
		$("#"+id).addClass("fade");
		$("#"+id).removeClass("active");
		$("#"+id).prev().removeClass("fade");
		$("#"+id).prev().addClass("active");
		
		$("#"+id+"-link").children().removeClass("active");
		$("#"+id+"-link").prev().children().addClass("active");
		
		var navlink = "nav-item-"+suffix;
		$("#"+navlink +" > a").removeClass("active");
		$("#"+navlink).prev().children().addClass("active");
	
	}
}