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


var notificationElement = null;

function notifyMe(message,body) {
    if (!window.Notification) {
        console.log('Browser does not support notifications.');
    } else {
        // check if permission is already granted
        if (Notification.permission === 'granted') {
            // show notification here
            var notify = new Notification(message, {
                body: body,
                icon: 'https://bit.ly/2DYqRrh',
            });
            notify.onclick = function () {
            	parent.focus();
                window.focus();
                this.close();
              };
        } else {
            // request permission from user
            Notification.requestPermission().then(function (p) {
                if (p === 'granted') {
                    // show notification here
                    var notify = new Notification(message, {
                        body: message,
                        icon: 'https://bit.ly/2DYqRrh',
                    });
                    notify.onclick = function () {
                    	parent.focus();
                        window.focus();
                        this.close();
                      };
                } else {
                    console.log('User blocked notifications.');
                }
            }).catch(function (err) {
                console.error(err);
            });
        }
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
		
		looprequest(baseurl+'index.php?resource=backend&module=notification&action=pullNotifications&requestId='+requestId,{},3000,function(resp){
			try {
				var res = JSON.parse(resp);
				if(res.data.status=="accepted") {
					emitNotification(res.data.payload);
							
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




function emitNotification(payload) {
	localStorage.setItem("notificationData",JSON.stringify({payload:payload}));
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


