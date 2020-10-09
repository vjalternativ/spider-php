var usertypes= {success:"System",warning:"System",primary : "You",danger : "User"};
var isChannelOpen = false;


function setIsChannelOpen(b) {
	isChannelOpen = b;
}
function getIsChannelOpen() {
	return isChannelOpen;
}

function preUpdateUI(event) {
	if(event == "connected" && isAgentLiveChat) {
		$("#alternativlabs-chatpanel").removeClass("hide");
		updatePresetUI();
		window.parent.connectChatWindow();
	}
} 



function updatePresetUI() {
	$("#chat-panel-body").removeClass("hide");
	$("#alternativlabs-chatform-panelbody").addClass("hide");
	$("#alternativlabs-chatform-panelfooter").removeClass("hide");
	$("#alternativlabs-chatbody").removeClass("hide");
	$("#entertosend").removeClass("hide");
}




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

	    
	  var chatob = chat;

	  $.post(baseurl+"index.php?resource=backend&module=chat&action=ajaxDisconnectChat&fw_sess_mode="+fw_sess_mode,{},function(response) {
		  	
			$("#stchathistory").html("");
			ChatUIHandler.setState(INITIAL);
				if(callback) {
		  			callback();
		  		}
			  
			}).fail(function(error) {
				
				setTimeout(function(){
					chatDisconnect(callback);
				},2000);
				
 			}

 		);
}


function looprequest(url,data,interval,callback)   {
	
	var request = $.ajax({
		  url: url,
		  method: "POST",
		  data: data
		});
		request.done(function( result ) {
			callback(result);
			setTimeout(function(){
				looprequest(url,data,interval,callback);
			},interval);
		});
		 
		request.fail(function( jqXHR, textStatus ) {
			setTimeout(function(){
				looprequest(url,data,interval,callback);
			},interval);
		});
	
}





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
		  this.isChatStarted = false;
		  this.connectAttempt = 0;
		  this.entercheckbox  = true;
		  this.data = {};
		  this.connectResponse = {};
	}

   initChat() {
  	//this.getOnlineUserNum();
  }


   onSendEnter() {
	if(this.entercheckbox) {
		this.onSend();	
	}
	
}

  getOnlineUserNum() {}


  
  readMessages() {
	  var url = fwbaseurl+"index.php?module=chat&action=ajaxReadPackets&fw_sess_mode="+fw_sess_mode;
	  var chatob = this;
	  looprequest(url,{},2000,function(result){
			  var data = parseJson(result);
			  if(data) {
				  var list = data.packets;
				  var listLength = list.length;
				  if(listLength && !getIsChannelOpen()) {
					  setIsChannelOpen(true);
					  document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "connected"}  }));
				  }
				  for(var i=0;i<listLength;i++) {
					  var data = list[i];
					  document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "i_message",data : data}  }));
				  }
			  }
	  });
  }
  
  processConnectResponse() {
	  var data = this.connectResponse;
	  
	  var chatob = this;
	  
			if(data.status == "offer" || data.status == "answer") {
				
				if(data.status=="answer") {
					setIsChannelOpen(true);
					  document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "connected"}  }));
				}
				chatob.readMessages();
				
			} else if(data.status == "no_user_avail") {
				
				
				chatob.pushdata(chatob.noUserAvailableMessage);
				
				setTimeout(function() {
					resetChatBoxForm();	
				},2000);
				
				
			} 
  }
  
  connect() {
	  var chatob = this;
	  if(!isAgentLiveChat) {
		  this.data.formdata = $("#chat_connnect_form").serializeArray();
	  }
			$.post(baseurl+"index.php?resource=backend&module=chat&action=createRoom",this.data,function(response) {
	  			console.log("Response ");
	  			console.log(response);
	  			var data = parseJson(response);
	  			chatob.connectResponse = data;
	  			chatob.processConnectResponse();
	  			
	  			
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
	  var chatob  = this;
	  var param = JSON.stringify(json);
	  var url = fwbaseurl+ "index.php?module=chat&action=ajaxPostMessage&fw_sess_mode="+fw_sess_mode;

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

	

  disconnectUI() {
          var now = new Date();

  				this.showSendBtn = false;
  				this.showConnect = true;
  				this.disableMessage= true;
  				var msg = "Chat session disconnected";
  				var message = {"mtype":"warning","message":msg,"timestamp":now};
  				updateUI();
  				this.pushdata(message);
  				
  				
  				if(isAgentLiveChat) {
  					onConnect();
  				} else {
  					resetChatBoxForm();
  				}
  				// this.chatHistory.push(message);
	
  	
  }


  
  
}



var chat = new LiveChat();
chat.initChat();

document.body.addEventListener("chatMessage",function(data){
	var datetext = data.detail.timestamp.toTimeString();
	datetext = datetext.split(' ')[0];
	var msg = '<p class="text-'+data.detail.mtype+'">'+usertypes[data.detail.mtype]+" : "+datetext+ " : "+ data.detail.message+'</p>';
	$("#stchathistory").append(msg);
	
	var objDiv = document.getElementById("stchathistory");
	objDiv.scrollTop = objDiv.scrollHeight;
});


document.body.addEventListener("dataChannelEvents",function(data){ 
	console.log("CHANNEL DATA EVENT");
	console.log(data);
	
		if(data.detail.event == "connected") {
			 	 chat.disableConnectButton =false; 
				 chat.showConnect = false; 
				 chat.showSendBtn = true;
				 chat.connectBtnText = 'Connect'; 
				 chat.disableMessage = false;
				 chat.chatId = "aaa"; 
				 chat.isChatStarted = true;
				 if(isAgentLiveChat) {
					 document.body.dispatchEvent(new CustomEvent('chatMessage', { type: 'success', detail:chat.connectedMessageUser })); 
				 } else {
					 document.body.dispatchEvent(new CustomEvent('chatMessage', { type: 'success', detail:chat.connectedMessage })); 
					 	 
				 }
				 preUpdateUI(data.detail.event);
				 updateUI();
				 
				 
		} else if(data.detail.event == "i_message") {
			var now = new Date();
			var pushData = {};
			pushData.mtype = "danger";
			pushData.user = "Stranger";
			pushData.timestamp = now;
			pushData.class = 'text-success';	
			
			var info = data.detail.data;
			
			
			if(info.name == "message") {
				pushData.message = info.description;
				chat.pushdata(pushData);
			} else if(info.name == "disconnect") {
					reloadFrame();
				
			}
			
		} else if(data.detail.event == "disconnected") {
			var chatdatachannel = dataChannel;  
			var con = peerConnection;
			chatdatachannel.close();
			con.close();
			
			chat.disconnectUI();
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
		reloadFrame();
	});

}



function chat_message_window() {
	 chat.disableConnectButton =false; 
	 chat.showConnect = false; 
	 chat.showSendBtn = true;
	 chat.connectBtnText = 'Connect'; 
	 chat.disableMessage = false;
	 chat.chatId = "aaa"; 
	 chat.isChatStarted = true;
	 
	 $("#alternativlabs-chatpanel").removeClass("hide");
	 updatePresetUI();
	 updateUI();
}

function handleFrameMessage(evt) {
		if(evt.data.event=="startChatWithUser") {
			/* var info = {};
			 info.name = "message";
			 info.description = "Please input the fist message";
			 document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "i_message",data : info}  }));
			 chat.readMessages();
			*/
			
			
			
		} else if(evt.data.event=="connectIncomingChat") {
			 var info = {};
			 info.name = "message";
			 info.description = evt.data.message;
			 //document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "i_message",data : info}  }));
			 chat.readMessages();
		}
}



$(document).ready(function(){
	
	
	if(isAgentLiveChat) {
		onConnect();
	} 
	
	
	window.addEventListener("message", handleFrameMessage, false);
	
	window.parent.postMessage({event:"frameLoaded"});
	
});