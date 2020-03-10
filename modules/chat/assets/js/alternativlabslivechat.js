

window.onload = function() {
	var chatutil = document.createElement("script");
	chatutil.type="text/javascript";
	chatutil.src=fwbaseurl+"modules/chat/assets/js/alternativlabslivechatutil.js";
	document.head.appendChild(chatutil);
	chatutil.onload = function(event){
		var autoconnect=true;
		if(DISABLE_CHAT_AUTOCONNECT) {
			autoconnect = false;
		}	
		createIframe("BACKEND",autoconnect);
	};
}
