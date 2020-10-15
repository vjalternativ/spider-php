function looprequest(url,data,interval,callback,validateCallback)   {
	if(validateCallback()) {
		
	var request = $.ajax({
		  url: url,
		  method: "POST",
		  data: data
		});
		request.done(function( result ) {
				callback(result);
				setTimeout(function(){
					looprequest(url,data,interval,callback,validateCallback);
				},interval);	
		});
		 
		request.fail(function( jqXHR, textStatus ) {
				setTimeout(function(){
					looprequest(url,data,interval,callback,validateCallback);
				},interval);
		});
	}
}


function getRequestId(callback) {
	var request = $.ajax({
		  url: baseurl+"index.php?resource=backend&module=notification&action=getRequestId",
		  method: "POST",
		  data: {}
		});
		request.done(function( result ) {
			
			try {
				var json = JSON.parse(result);
				callback(json.data);	
			} catch(e) {
				setTimeout(function(){
					getRequestId(callback);
				},3000);
			}
			
		});
		 
		request.fail(function( jqXHR, textStatus ) {
			setTimeout(function(){
				getRequestId(callback);
			},3000);
		});
		
}

function pullNotifications(requestId) {
	
	var stop = false;
		
		looprequest(baseurl+'index.php?resource=backend&module=notification&action=pullNotifications&requestId='+requestId+"&clientResource="+resource,{},3000,function(resp){
			try {
				var res = JSON.parse(resp);
				if(res.data.status=="accepted") {
					emitNotification(res.data);
							
				} else if(res.data.status=="rejected") {
					stop = true;
				}
			} catch(e) {
				console.log(e);
			}
			
		},function(){
			if(stop) {
				setTimeout(function(){
					pullNotifications(requestId);
				},15000);
				return false;
			}
			return true;
		});
	
	
	
}




function emitNotification(data) {
	if(data.payload.length > 0) {
		var messages = [];
		for(var i=0;i<data.payload.length;i++) {
			var notification = data.payload[i];
			if(notification.type=="notification") {
				notifyMe(notification.data);
			} else {
				messages.push(notification);		
			}
		}
		
		if(messages.length > 0) {
			localStorage.setItem("notificationData_"+resource,JSON.stringify({payload:messages,id:data.id}));
		}
		
		
	}
}


$(document).ready(function(){
	notificationElement  = document.getElementById("notificationelement");
	if (!Notification) {
		  alert('Desktop notifications not available in your browser. Try Chromium.');
		 
	} else {
		if (Notification.permission !== 'granted') {
			  Notification.requestPermission();
		 }	
	}


	getRequestId(function(requestId){
		pullNotifications(requestId);
	});
	
});


