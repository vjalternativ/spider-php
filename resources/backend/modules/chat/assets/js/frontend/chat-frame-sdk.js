const INITIAL ="INITIAL";
const CONVERSATION = "CONVERSATION";
const MINIMIZE = "MINIMIZE";
const CHATFORM = "CHATFORM";
const CONNECTING = "CONNECTING";


ChatFrame = {};

ChatFrame.state = {};
ChatFrame.state.INITIAL = {height:40,width:250};
ChatFrame.state.MINIMIZE = {height:40,width:430};
ChatFrame.state.CONVERSATION = {height:420,width:430};
ChatFrame.state.CONNECTING = {height:420,width:430};
ChatFrame.state.CHATFORM = {height:357,width:430};

ChatFrame.element = null;

ChatFrame.createIFrame = function(sessmode,autoconnect) {
	var resizerScript = document.createElement("script");
	resizerScript.type="text/javascript";
	resizerScript.src=fwbaseurl+"resources/backend/modules/chat/assets/js/iframeResizer.min.js";
	document.head.appendChild(resizerScript);
	resizerScript.onload = function(event){
		var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below

		iFrameResize( {
			widthCalculationMethod: isOldIE ? 'max' : 'rightMostElement'
		});
	}
	
	ChatFrame.element = document.createElement("iframe");
	ChatFrame.element.frameBorder=0;
	ChatFrame.element.id="alternativlabschatbox";
	ChatFrame.element.style.position="fixed";
	ChatFrame.element.style.right=0;
	ChatFrame.element.style.bottom=0;
	ChatFrame.element.style.zIndex=9999999;
	ChatFrame.element.width=ChatFrame.state.INITIAL.width + "px";
	ChatFrame.element.height=ChatFrame.state.INITIAL.height + "px";
	ChatFrame.element.setAttribute("marginheight","1");
	ChatFrame.element.setAttribute("marginwidth","1");
	ChatFrame.element.setAttribute("seamless","seamless");
	ChatFrame.element.setAttribute("scrolling","no");
	ChatFrame.element.setAttribute("allowtransparency","true");
	ChatFrame.element.setAttribute("allow","*");
	var chaturl = baseurl+"index.php?resource=backend&module=chat&fw_sess_mode="+sessmode;
	
	if(autoconnect) {
		chaturl += "&autoconnect=1";
	}
	ChatFrame.element.setAttribute("src",chaturl);
	document.body.appendChild(ChatFrame.element);
	
}

ChatFrame.setFrameState = function(state) {
	console.log("INFO : setting frame state ",state);
	
	var stateob = ChatFrame.state[state];
	
	ChatFrame.element.height = stateob.height+"px";
	ChatFrame.element.width = stateob.width+"px";;
}

ChatFrame.openchat = function() {
	ChatFrame.setFrameState(CONVERSATION);	
} 




ChatFrame.minimizechat = function() {
	ChatFrame.setFrameState(INITIAL);	
	
}

ChatFrame.resetchat = function() {
    
	ChatFrame.setFrameState(INITIAL);	
	
	var message = {};
	message.event = "resetchat";
	
	window.parent.postMessage(message);
	
}

ChatFrame.connectChatWindow = function() {
	ChatFrame.setFrameState(CONVERSATION);	
}

var chatFrameloadedBool  = false;

ChatFrame.setChatFrameLoaded = function(b) {
	chatFrameloadedBool = b;
}



ChatFrame.isChatFrameLoaded = function() {
	return chatFrameloadedBool;
}


function handleChatBoxEvent(payload) {
	switch(payload.data.event) {
			
	case "frameLoaded" :
		ChatFrame.setChatFrameLoaded(true);
		break;
	case "uiStateChange" :
		ChatFrame.setFrameState(payload.data.state);	
		break;
	
	default : 
		 console.log("WARN : unknown event ",payload);	
		break;
			
	}
}

window.addEventListener("message",handleChatBoxEvent,false);

