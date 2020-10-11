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


$(document).ready(function(){
	notificationElement  = document.getElementById("notificationelement");
	
	if (!Notification) {
		  alert('Desktop notifications not available in your browser. Try Chromium.');
		  return;
		 }

		 if (Notification.permission !== 'granted') {
			  Notification.requestPermission();
		 } 
		 
});


