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

