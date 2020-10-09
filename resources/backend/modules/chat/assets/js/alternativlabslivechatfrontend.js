window.onload = function() {
	var chatutil = document.createElement("script");
	chatutil.type="text/javascript";
	chatutil.src=fwbaseurl+"resources/backend/modules/chat/assets/js/frontend/chat-frame-sdk.js";
	document.head.appendChild(chatutil);
	chatutil.onload = function(event){
		ChatFrame.createIFrame("FRONTEND");	
	};
}




