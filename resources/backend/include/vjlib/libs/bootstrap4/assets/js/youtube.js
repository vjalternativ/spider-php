function playYoutubeVideo(title,id) {
	
	var iframe = document.createElement("iframe");
	iframe.id="youtube_iframe";
	iframe.height="400";
	iframe.width="100%";
	iframe.src='https://www.youtube.com/embed/'+id;
	
	
	$(iframe).attr("allowfullscreen","allowfullscreen");
	$("#primary_modal .modal-title").html(title);
	$("#primary_modal .modal-body").html(iframe);
	
	$("#primary_modal").modal("show");
	
}

$(document).ready(function(){
	$("#primary_modal").on('hide.bs.modal', function () {
	  
		$("#youtube_iframe").remove();
	});
});