const INITIAL ="INITIAL";
const CONVERSATION = "CONVERSATION";
const MINIMIZE = "MINIMIZE";
const CHATFORM = "CHATFORM";
const CONNECTING = "CONNECTING";




ChatUIHandler = {};


ChatUIHandler.state = {};


ChatUIHandler.currentState = INITIAL;
ChatUIHandler.prevState = INITIAL;

ChatUIHandler.buildState = function(state,id,key,addclass,removeclass) {
	var stateob = ChatUIHandler.state[state];
	stateob[key] = {
			id : id,
			addclass : addclass,
			removeclass : removeclass
	};
	ChatUIHandler.state[state] = stateob;
}
ChatUIHandler.state.INITIAL = function() {
	$("#alternativlabs-chatbody").addClass("hide");
	$("#alternativlabs-chatform-panelbody").addClass("hide");
	$("#chat-panel-body").addClass("hide");
	$("#alternativlabs-chatform-panelfooter").addClass("hide");
	$("#chatmaximize").removeClass("glyphicon-minus");
	$("#chatmaximize").addClass("glyphicon-plus");
};


ChatUIHandler.state.CHATFORM = function() {
	$("#alternativlabs-chatbody").addClass("hide");
	$("#alternativlabs-chatform-panelbody").removeClass("hide");
	$("#chat-panel-body").removeClass("hide");
	$("#alternativlabs-chatform-panelfooter").removeClass("hide");
	$("#chatmaximize").removeClass("glyphicon-plus");
	$("#chatmaximize").addClass("glyphicon-minus");
};


ChatUIHandler.state.CONNECTING = function() {
	$("#alternativlabs-chatform-panelbody").addClass("hide");
	$("#alternativlabs-chatbody").removeClass("hide");
	$("#chat-panel-body").removeClass("hide");
	$("#alternativlabs-chatform-panelfooter").removeClass("hide");
	
	$("#chatmaximize").removeClass("glyphicon-plus");
	$("#chatmaximize").addClass("glyphicon-minus");
	
	$("#stconnectbtn").attr("disabled",true);
	$("#stconnectbtn").removeClass("hide");
	$("#stdisconnectbtn").addClass("hide");
	$("#stconnectbtn").html("Connecting..");
	$("#stmsgbox").attr("disabled",true);
};

ChatUIHandler.state.CONVERSATION = function() {
	$("#alternativlabs-chatbody").addClass("hide");
	$("#alternativlabs-chatform-panelbody").removeClass("hide");
	$("#chat-panel-body").removeClass("hide");
	$("#alternativlabs-chatform-panelfooter").removeClass("hide");
	$("#chatmaximize").removeClass("glyphicon-plus");
	$("#chatmaximize").addClass("glyphicon-minus");
};

ChatUIHandler.state.MINIMIZE = function() {
	$("#alternativlabs-chatbody").addClass("hide");
	$("#alternativlabs-chatform-panelbody").addClass("hide");
	$("#chat-panel-body").addClass("hide");
	$("#alternativlabs-chatform-panelfooter").addClass("hide");
	$("#chatmaximize").removeClass("glyphicon-minus");
	$("#chatmaximize").addClass("glyphicon-plus");
};








ChatUIHandler.setState = function(state) {
	
	ChatUIHandler.prevState=ChatUIHandler.currentState;
	ChatUIHandler.state[state]();
	ChatUIHandler.currentState=state;
	window.parent.postMessage({event:"uiStateChange",state:state});

}

function openchat() {
	
	switch(ChatUIHandler.currentState) {
		case INITIAL :
			ChatUIHandler.setState(CHATFORM);
			break;
		case CHATFORM :
			ChatUIHandler.setState(INITIAL);
			break;
			 CONVERSATION :
				ChatUIHandler.setState(MINIMIZE);
			break;
		case MINIMIZE :
			ChatUIHandler.setState(CONVERSATION);
			break;
		 default :
			 break;
	}
	
}