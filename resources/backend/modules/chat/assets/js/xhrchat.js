var usertypes= {success:"System",warning:"System",primary : "You",danger : "User"};




function onSend() {
	chat.message = $("#stmsgbox").val();
	$("#stmsgbox").val("");
	chat.onSend();

}

function show(id,b) {
	if(b) {
		$("#"+id).show();
	} else {
		$("#"+id).hide();
	}
} 


function parseJson(res)  {
	var result = false;
	try {
		result =  JSON.parse(res);
	} catch(e) {
		result = false;
	}
	return result;
}

function chatDisconnect(callback) {
	$('#chat_connnect_form').trigger("reset");
	  $.post(baseurl+"index.php?resource=backend&module=chat&action=ajaxDisconnectChat&room_id="+chatob.room_id+"&member_id="+chatob.member_id,{},function(response) {
			chatob.roomActive = false;
		  	if(!isAgentLiveChat) {
				$("#stchathistory").html("");
				ChatUIHandler.setState(INITIAL);
			}
	  		if(callback) {
	  			callback();
	  		}
			  
			}).fail(function(error) {
				chatob.roomActive = false;
				setTimeout(function(){
					chatDisconnect(callback);
				},2000);
			}
 		);
}


function looprequest(url,data,interval,callback,validateCallback)   {
	
	var request = $.ajax({
		  url: url,
		  method: "POST",
		  data: data
		});
		request.done(function( result ) {
			if(validateCallback()) {
				callback(result);
				setTimeout(function(){
					looprequest(url,data,interval,callback,validateCallback);
				},interval);	
			}
			
		});
		 
		request.fail(function( jqXHR, textStatus ) {
			if(validateCallback()) {
				setTimeout(function(){
					looprequest(url,data,interval,callback,validateCallback);
				},interval);
			}
		});
	
}



var chatob = null;

class LiveChat {
  
	constructor()  {
		  this.message = "";
		  this.chatHistory = [];
		  this.onlineUserNum = 1;
		  this.disableConnectButton = false;
		  this.showConnect = true;
		  this.showSendBtn = false;
		  this.disableMessage = true;
		  this.connectMessage = {"mtype":"success","type":"message","message":"Connecting To user please wait...","timestamp":new Date()};
		  this.connectedMessage = {"mtype" : "success","type":"message","message":"You are successfully connected with agent.","timestamp":new Date()};
		  this.connectedMessageUser = {"mtype" : "success","type":"message","message":"You are successfully connected with user.","timestamp":new Date()};
		  this.noUserAvailableMessage = {"mype":"warning","type":"message","message":"Sorry, no users are available. Please try again later.","timestamp":new Date()};
		  this.connectBtnText = 'Connect';
		  this.chatId = '';
		  this.connectAttempt = 0;
		  this.entercheckbox  = true;
		  this.data = {};
		  this.connectResponse = {};
		  this.roomId = "";
		  this.memberId = "";
		  this.roomActive = false;
		  chatob  = this;
	}

  

   onSendEnter() {
	if(this.entercheckbox) {
		this.onSend();	
	}
	
}

  getOnlineUserNum() {}


  
  readMessages(room_id,member_id) {
	  chatob.room_id = room_id;
	  chatob.member_id = member_id;
	  var url = baseurl+"index.php?resource=backend&module=chat&action=ajaxGetMyMessages&room_id="+room_id+"&member_id="+member_id;
	  
	  looprequest(url,{},2000,function(result){
			  var data = parseJson(result);
			  if(data.status=="success") {
				  var list = data.data.messages;
				  var listLength = list.length;
				  for(var i=0;i<listLength;i++) {
					  var data = list[i];
					  data = parseJson(data);
					  console.log("dispatch message event",data);
					  document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : data.type,data : data.message}  }));
				  }
			  }
	  },function(){
		  if(chatob.roomActive) {
			  return true;
		  }
		  return false;
	  });
  }
  

  
  connect() {
	 
		  if(!isAgentLiveChat) {
			  this.data.formdata = $("#chat_connnect_form").serializeArray();
		  }
			$.post(baseurl+"index.php?resource=backend&module=chat&action=createRoom",this.data,function(response) {
	  			var data = parseJson(response);
	  			if(data.status=="success") {
	  				chatob.roomActive = true;
	  				chatob.room_id = data.data.room_id;
	  				chatob.member_id = data.data.member_id;
	  			} else {
	  				chatob.connect();
	  			} 
	  		}).fail (function(error) {
	  			chatob.connect();
	  		});
  }

  pushdata(messageData) {
	  	document.body.dispatchEvent(new CustomEvent('chatMessage', {detail: messageData  }));
  }
  
  onConnect() {
	  if(!isAgentLiveChat) {
		  ChatUIHandler.setState(CONNECTING);  
		    
	  }
	var now = new Date();
  	this.connectAttempt++;
  	this.chatHistory = [];
  	this.chatHistory.push(this.connectMessage);
  	document.body.dispatchEvent(new CustomEvent('chatMessage', {detail: this.connectMessage  }));
  	this.connectMessage.timestamp = now;
  	
  	
  	
  	this.connect();
  	
  }
  
  
  sendMessage(json) {
	  
	  var param = JSON.stringify(json);
	  var url = baseurl+ "index.php?resource=backend&module=chat&action=ajaxPostMessage&room_id="+chatob.room_id+"&member_id="+chatob.member_id;
  			$.post(url,{data:param},function(resp) {}).fail(function(error) {
				chatob.sendMessge(json);
			});
  }
  
  onSend() {
  	var now = new Date();
  	var message = {"mtype" :"primary","type":"message","message":this.message,"timestamp":now};
  	var json = { action: "message", data: this.message};

  	this.pushdata(message);
	
  	this.sendMessage(json);
  }

	

  


  
  
}



var chat = new LiveChat();

document.body.addEventListener("chatMessage",function(data){
	var now = new Date();
	var datetext = now.toTimeString();
	datetext = datetext.split(' ')[0];
	var msg = '<p class="text-'+data.detail.mtype+'">'+usertypes[data.detail.mtype]+" : "+datetext+ " : "+ data.detail.message+'</p>';
	$("#stchathistory").append(msg);
	
	var objDiv = document.getElementById("stchathistory");
	objDiv.scrollTop = objDiv.scrollHeight;
});




document.body.addEventListener("dataChannelEvents",function(data){ 
	
	
	
	 if (document.visibilityState != 'visible' ||  !tabFocused || document.hidden) {
			notifyMe("Message Recvied : "+data.detail.event,data.detail.data);
			
			try {
				notificationElement.play(); 	
			} catch(e) {
				console.log("not able to play");
			}
		}
	
		if(data.detail.event == "connected") {
			 	 
				 if(isAgentLiveChat) {
					 document.body.dispatchEvent(new CustomEvent('chatMessage', { type: 'success', detail:chat.connectedMessageUser })); 
				 } else {
					 document.body.dispatchEvent(new CustomEvent('chatMessage', { type: 'success', detail:chat.connectedMessage })); 
					 	 
				 }
				 ChatUIHandler.setState(CONVERSATION);
				 
				 
		} else if(data.detail.event == "message") {
			
			var now = new Date();
			var pushData = {};
			pushData.mtype = "danger";
			pushData.user = "Stranger";
			pushData.timestamp = now;
			pushData.class = 'text-success';	
			pushData.message = data.detail.data;
			chat.pushdata(pushData);
			
			
		} else if(data.detail.event == "disconnected") {
			chatob.roomActive = false;
			var pushData = {};
			pushData.mtype = "danger";
			pushData.user = "Stranger";
			pushData.timestamp = now;
			pushData.class = 'text-warning';	
			pushData.message = data.detail.data;
			chat.pushdata(pushData);
			if(!isAgentLiveChat) {
				setTimeout(function(){
					ChatUIHandler.setState(INITIAL);  
				},2000); 
			}
		}
});




function onConnect() {
	chat.onConnect();
}



function reloadFrame() {
	ChatUIHandler.setState(INITIAL);
	window.location.reload();
}

function onDisconnect() {
	chatDisconnect(function(){
	});

}



function handleFrameMessage(evt) {
		console.log("handing frame message",evt);
}

var tabFocused = true;




function checkNotificatonStorage(e) {
	
	var notificationData = localStorage.getItem("notificationData");
	console.log("notification data",notificationData);
}

$(document).ready(function(){

	if(isAgentLiveChat) {
		var roomId = document.getElementById("room_id").value;
		var memberId = document.getElementById("member_id").value;
		chatob.roomActive = true;
		chat.readMessages(roomId,memberId);
	} 
	
	
	window.addEventListener("storage", checkNotificatonStorage,false);
	
	window.addEventListener("message", handleFrameMessage, false);
	
	window.parent.postMessage({event:"frameLoaded"});
	
	document.addEventListener("visibilitychange", function() {
		  if (document.visibilityState === 'visible') {
			  tabFocused=true;
		  } else {
			  tabFocused=false;
		  }
	},false);
});