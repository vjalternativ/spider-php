function loadScript(url,callback) {
	var chatutil = document.createElement("script");
	chatutil.type="text/javascript";
	chatutil.src=url;
	document.head.appendChild(chatutil);
	chatutil.onload = function(event){
		callback();
	};	
}


function loadScripts(scripts,index) {
	if(index < scripts.length) {
		index++;
		var url = scripts[index];
		loadScript(url,function() {
			loadScripts(scripts,index);
		});
	}
}

window.onload = function() {
	loadScript(fwbaseurl+"libs/assets/js/lib_iframe.js",function(){
			lib_iframe.createIFrame("notificationframe",baseurl+"index.php?resource=backend&module=notification&action=index",{display:"none"});
			loadScript(fwbaseurl+"resources/backend/modules/chat/assets/js/frontend/chat-frame-sdk.js",function(){
				ChatFrame.element = lib_iframe.createIFrame("livechatframe",baseurl+"index.php?resource=backend&module=chat&action=index",{width:ChatFrame.state.INITIAL.width,height:ChatFrame.state.INITIAL.height});
			});
	});
}




