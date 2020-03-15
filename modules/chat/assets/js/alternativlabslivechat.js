



window.onload = function() {
	var chatutil = document.createElement("script");
	chatutil.type="text/javascript";
	chatutil.src=fwbaseurl+"modules/chat/assets/js/alternativlabslivechatutil.js?v=2";
	document.head.appendChild(chatutil);
	chatutil.onload = function(event){
		var autoconnect=true;
		createIframe("BACKEND",autoconnect);
	};
}
