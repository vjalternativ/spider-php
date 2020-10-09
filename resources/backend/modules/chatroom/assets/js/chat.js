var dataChannel = null;
var isChannelOpen = false;
var isWebRTC = false;
var usertypes= {success:"System",warning:"System",primary : "You",danger : "User"};
function openchat() {
	
	if($("#chat-panel-body").hasClass("hide")) {
		$("#chat-panel-body").removeClass("hide");
		$("#alternativlabs-chatform-panelfooter").removeClass("hide");
		$("#chatmaximize").removeClass("glyphicon-plus");
		$("#chatmaximize").addClass("glyphicon-minus");
		if($("#alternativlabs-chatform-panelbody").hasClass("hide")) {
			window.parent.connectChatWindow();
				
		} else {
			window.parent.openchat();
			
		}
		
			
	} else {
		$("#chat-panel-body").addClass("hide");
		$("#alternativlabs-chatform-panelfooter").addClass("hide");
		$("#chatmaximize").removeClass("glyphicon-minus");
		$("#chatmaximize").addClass("glyphicon-plus");
		window.parent.minimizechat();
		
	}
	
}


function resetChatBoxForm() {
	$("#alternativlabs-chatbody").addClass("hide");
	$("#alternativlabs-chatform-panelbody").removeClass("hide");
	window.parent.openchat();
	$("#stconnectbtn").attr("disabled",false);
	$("#stconnectbtn").html("Connect");
	
}	



var config = {"iceServers":[{"url":"stun:stun.l.google.com:19302"}]};
var connection = { 
	'optional': 
		[{'DtlsSrtpKeyAgreement': false}, {'RtpDataChannels': true }] 
};
connection = {};


var sdpConstraints = {'mandatory':
{
  'OfferToReceiveAudio': false,
  'OfferToReceiveVideo': false
}
};

sdpConstraints = { offerToReceiveAudio: false,  offerToReceiveVideo: false};


function setChannelOpen(b) {
	isChannelOpen  = b;
}

function getChannelOpenStatus() {
	return isChannelOpen;
}


isSdpSent = false;

function send_sdp_to_remote_peer() {
	 if (isSdpSent) return;
	    isSdpSent = true;
	  
	    var sdp = peerConnection.localDescription;
	    
	    console.log("FINAL SDP");
	    console.log(sdp.sdp);
	    sendNegotiation(sdp.type, sdp,function(){});
	  //  socket.emit('remote-sdp', sdp);
}


function reloadFrame() {
	window.location.reload();
}

function openDataChannel (){
	
	
	console.log("CREATING NEW PEER CONNECTION");
    peerConnection = new webkitRTCPeerConnection(config, connection);
    
	console.log("CREATING NEW DATA CHANNEL");
    dataChannel = peerConnection.createDataChannel("datachannel",{reliable:false});

    peerConnection.onicecandidate = function(e){

    	if (e.candidate === null) {
            return send_sdp_to_remote_peer();
        }    	
    	
 /*   	console.log("RECIVING ICE CANDIDATE AND SENDING NEGOTIATION");
        if (!peerConnection || !e || !e.candidate) return;
        var candidate = event.candidate;
        sendNegotiation("candidate", candidate,function(){});*/
    }

    
    dataChannel.onopen = function(){
    	console.log(" --- DC OPENED");
    	setChannelOpen(true);
    	
	  	document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "connected"}  }));

    };
    dataChannel.onclose = function(){
    	isSdpSent = false;
    	setChannelOpen(false);
        
    	console.log("------ DC closed! ------")
      	document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "disconnected"}  }));

    };
    dataChannel.onerror = function(event){
    	
    	console.log("DC ERROR!!!");
    	console.log(event);
    };
    dataChannel.onmessage = function(e) {
    	console.log("DC MESSAGE");
         
    	document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "i_message","data" : e.data}  }));

    }
    peerConnection.ondatachannel = function (ev) {
        console.log('peerConnection.ondatachannel event fired.');
        ev.channel.onopen = function() {
            console.log('Data channel is open and ready to be used.');
        };
        ev.channel.onmessage = function(e){
           console.log("DC MESG");
        document.body.dispatchEvent(new CustomEvent('dataChannelEvents', {detail:{event : "i_message","data" : e.data}  }));

           
        }
    };
    
    peerConnection.onsignalingstatechange = function(e) {
    	console.log("signaling state event");
    	console.log(peerConnection.signalingState);
    };
    
    peerConnection.oniceconnectionstatechange = function(event) {
    	console.log("ice connection state event");
    	console.log(peerConnection.iceConnectionState);
    	
    	if (peerConnection.iceGatheringState === 'complete') {
            send_sdp_to_remote_peer();
        } else if(peerConnection.iceConnectionState == "disconnected") {
        	enableReadPacket  = false;
        	reloadFrame();
    	}
    	
    };
    
    peerConnection.onicegatheringstatechange = function(event) {
    	console.log("ice gathering state event");
    	console.log(peerConnection.iceGatheringState);
    };
    
    peerConnection.onnegotiationneeded = function(event) {
    	console.log("negotiation needed");
    	chat.connect();
    };

    return peerConnection;
}


var peerConnection = null;





function sendNegotiation(type, sdp,callback){

	console.log("sending negotiation");
		    var json = { from: "peer", to: "callserver", action: type, data: sdp};

		    var param = JSON.stringify(json);
		    	var url = baseurl+ "index.php?module=chat&action=ajaxhandlesignal";

		    	$.post(url,{data:param},function(resp) {
						console.log("response");
						console.log(resp);
						callback();
			    });

		}


var enableReadPacket = true;

function handlePackets() {
	
	if(enableReadPacket) {
		console.log("READING PACKETS");
		  var chatob = this;
		  var url = baseurl+"index.php?module=chat&action=ajaxReadPackets";
		  $.post(url,{},function(response){
			  console.log("packets");
			  	var res  = JSON.parse(response);
			  	console.log(res);
			  	var isChOpen = getChannelOpenStatus();
			  	if(!isChOpen) {
			  		console.log("processing packet");
			  		if(res.status== "invalid.state") {
			  			reloadFrame();
			  		} else {
			  			accept(res);
			  		  
			  		}
			  	}
				
		  });

	}
		  

		
	}


function processOffer(offer){
	console.log("processing offer");
	console.log("setting remote  SDP");
	
    peerConnection.setRemoteDescription(new RTCSessionDescription(offer)).catch(e => {
        console.log(e);
        reloadFrame();
    });

    

    console.log("creating answer");
    peerConnection.createAnswer(sdpConstraints).then(function (sdp) {

        console.log("setting local SDP");
        return peerConnection.setLocalDescription(sdp).then(function() {            
        
            //console.log("seinding answer");
            
        	//sendNegotiation("answer", sdp,function(){});
        });
    }, function(err) {
        console.log(err)
    });
   
}


function processIce(iceCandidate){
	console.log("adding ice candidate to peer connection");

  peerConnection.addIceCandidate(new RTCIceCandidate(iceCandidate));
}


function processAnswer(answer){
	console.log("processing answer");
	console.log("setting remote SDP");
	
  peerConnection.setRemoteDescription(new RTCSessionDescription(answer)).catch(e => {
      console.log(e);
      reloadFrame();
  });
}


function accept(res) {
	var packets = res.packets;
	usertypes.danger=res.name;
	
	if(packets) {
		var i=0;
		for(i=0;i< packets.length;i++) {
			var json = packets[i];
		
	
			var sdp = JSON.parse(json.description);
			console.log("processing sdp "+json.name);
			console.log(sdp);
			if(json.name == "candidate"){
				processIce(sdp);
			} else if(json.name == "offer"){
				processOffer(sdp)
			} else if(json.name == "answer"){
				processAnswer(sdp);
			}
	
		}
	}
	setTimeout(handlePackets,3000);

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

  getOnlineUserNum() {

	  var chatob = this;
  	$.post(baseurl+"index.php?module=chat&action=ajaxGetOnlineUsers",{},function(response) {
  			chatob.onlineUserNum = response;
  			$("#onlineusers").html(response);
  		}).fail(function(error) {
  			console.log(error);
  		}
  		);
  }

	 	
 
	
  sendOffer() {
	  var chatob = this;
	 	peerConnection.createOffer(function (sdp) {

			console.log("setting local desc");
			console.log(sdp);
			
			peerConnection.setLocalDescription(sdp);
			
			
			handlePackets();
			/*chatob.waitforIceGatheringComplete(function(){
				sendNegotiation("offer", sdp,handlePackets);

			});*/
		}, function(a){ 
			
			reloadFrame();
			console.log("second func");console.log(a);
			
		}, sdpConstraints);


	}
  
  


	  
 
  
  waitforIceGatheringComplete(callback) {
	  console.log("waiting ice gathering");
		var chatob = this;
		if(peerConnection!=null && peerConnection.iceGatheringState == "complete") {
			callback();
		} else {
			setTimeout(function(){
				chatob.waitforIceGatheringComplete(callback);
			},1000);
		}
		
  }
  
  processConnectResponse() {
	  var data = this.connectResponse;
	  
	  var chatob = this;
	  
			if(data.status == "offer") {
				console.log("sending offer");
				chatob.sendOffer();
			} else if(data.status == "no_user_avail") {
				
				
				chatob.pushdata(chatob.noUserAvailableMessage);
				
				setTimeout(function() {
					resetChatBoxForm();	
				},2000);
				
				
			} else if(data.status == "answer") {
				console.log("answering offer");
				console.log(data);
				accept(data);
			} 
  }
  
  connect() {
	  var chatob = this;
	  if(!isAgentLiveChat) {
		  this.data.formdata = $("#chat_connnect_form").serializeArray();
	  }
	  
	  
			$.post(baseurl+"index.php?module=chat&action=ajaxStrangerChatConnect",this.data,function(response) {
	  			console.log("Response ");
	  			console.log(response);
	  			//peerConnection = openDataChannel();
	  			var data = JSON.parse(response);
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
	window.parent.connectChatWindow();  
    var now = new Date();
  	this.disableConnectButton = true;
  	this.connectAttempt++;
  	this.chatHistory = [];
  	this.chatHistory.push(this.connectMessage);
  	document.body.dispatchEvent(new CustomEvent('chatMessage', {detail: this.connectMessage  }));
  	this.connectMessage.timestamp = now;
  	this.connectBtnText = 'Loading...';
  	updateUI();
  	peerConnection = openDataChannel();
		
  	//this.connect();
  	
  }
  sendMessge(data) {

	  var chatob = this;
  		$.post(baseurl+"index.php?module=chat&action=ajaxSendMessage",data,function(response) {
  				var result = JSON.parse(response);
  			}).fail(function(error) {
  				chatob.sendMessge(data);
  			}
  		);
  }

  onSend() {
  	var now = new Date();
  	var message = {"mtype" :"primary","type":"message","message":this.message,"timestamp":now};
  	this.pushdata(message);
	//var data = {"message":this.message,"chatId":this.chatId};	
 	
  	var message = JSON.stringify(message);
  	dataChannel.send(message);
 	 
  	this.message  = '';
  	//this.sendMessge(data);
  }

	

  getChatData() {

	  var chatob = this;
  		if(chatob.isChatStarted) {
  				$.post(baseurl+"index.php?module=chat&action=ajaxGetChatData",{"chatId":chatob.chatId},function(response) {
  							var data = JSON.parse(response);
  							var now = new Date();
  							if(data.status=='disconnected') {
  								chatob.disconnectUI();	
  							} else {
  								if(data.chatlog.length>=1) {
  									var mid = "";
  									for(var i=0;i<data.chatlog.length;i++) {
  											
  										data.chatlog[i].mtype = "danger";
  										data.chatlog[i].user = "Stranger";
  										data.chatlog[i].timestamp = now;
  										data.chatlog[i].class = 'text-success';	
  										if(mid == data.chatlog[i].mid) {
  											continue;
  										}
  										chatob.pushdata(data.chatlog[i]);
  										mid = data.chatlog[i].mid;
  										// chatob.chatHistory.push(data.chatlog[i]);
  									}
  								}
  								chatob.getChatData();
  							}	
  						}).fail(function(error) {
  							chatob.getChatData();
  				  });
  		}

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


function getInitMessage() {
	$.post(baseurl+"index.php?module=chat&action=getInitMessage",this.data,function(response) {
		console.log("init mesg");
		console.log(response);
		var result = JSON.parse(response);
		if(result.status=="success") {
			var now = new Date();
		  	var message = {"mtype" :"danger","type":"message","message":result.desc,"timestamp":now};
		  	chat.pushdata(message);
			
		}
	});
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
				 document.body.dispatchEvent(new CustomEvent('chatMessage', { type: 'success', detail:chat.connectedMessage })); 
				 preUpdateUI(data.detail.event);
				 updateUI();
				 
				 if(isAgentLiveChat) {
					getInitMessage();
				 }
				 
		} else if(data.detail.event == "i_message") {
			var now = new Date();
			var pushData = {};
			pushData.mtype = "danger";
			pushData.user = "Stranger";
			pushData.timestamp = now;
			pushData.class = 'text-success';	
			
			var info = JSON.parse(data.detail.data);
			
			//chat.pushdata(pushData);
			
			
			if(info.type == "message") {
				pushData.message = info.message;
				chat.pushdata(pushData);
			} else if(info.type == "signal") {
				console.log(info);
				var signal = info.signal;
				
				if(signal=="disconnect") {
					reloadFrame();
				}
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


function onDisconnect() {
	chatDisconnect(function(){
		reloadFrame();
	});

}

function chatDisconnect(callback) {
	 
	$('#chat_connnect_form').trigger("reset");

	 var chatdatachannel = dataChannel;  
	    
	  var chatob = chat;

	  var con = peerConnection;
	  $.post(baseurl+"index.php?module=chat&action=ajaxDisconnectChat",{},function(response) {
		  var message = {"type" :"signal","signal":"disconnect","message":"disconnected"};
		  	var message = JSON.stringify(message);
		  	
		  	if(getChannelOpenStatus()){
		  		
		  		try {
		  		  chatdatachannel.send(message);
				} catch(e) {
			  		console.log("chat execption ",e);
			  	}
				
				try {
					chatdatachannel.close();
				} catch(e) {
					console.log("chat exception ",e);
				}
				
				try {
					con.close();
				} catch(e) {
					console.log("chat exception ",e);
				}
		  				
		  	}

			$("#stchathistory").html("");
		  	window.parent.minimizechat();
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


function preUpdateUI(event) {
	if(event=="connected" && isAgentLiveChat) {
		$("#alternativlabs-chatpanel").removeClass("hide");
		updatePresetUI();
	}
} 


function updateUI() {
	
	$("#stconnectbtn").attr("disabled",chat.disableConnectButton);
	show("stconnectbtn",chat.showConnect);
	show("stsendbtn",chat.showSendBtn);
	show("stdisconnectbtn",chat.showSendBtn);
	$("#stconnectbtn").html(chat.connectBtnText);
	$("#stmsgbox").attr("disabled",chat.disableMessage);
	
}

function onUserConnect() {
	$("#chat_connnect_form").validate();
	var isvalid = $("#chat_connnect_form").valid();
	if(isvalid) {
		updatePresetUI();
		onConnect();
	}
	
}

function updatePresetUI() {
	$("#chat-panel-body").removeClass("hide");
	$("#alternativlabs-chatform-panelbody").addClass("hide");
	$("#alternativlabs-chatform-panelfooter").removeClass("hide");
	$("#alternativlabs-chatbody").removeClass("hide");
	$("#entertosend").removeClass("hide");
}

$(document).ready(function(){
	if(isAgentLiveChat) {
		onConnect();
	} 
});


window.onbeforeunload = function (e) {
	chatDisconnect(function(){});
};