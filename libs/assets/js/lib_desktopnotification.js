var notificationElement = document.createElement("audio");
notificationElement.src= fwbaseurl + "resources/backend/modules/chat/assets/sounds/juntos-607.wav";


function _notifyMe(message,body) {
	var notify = new Notification(message, {
        body: body,
        icon: 'https://bit.ly/2DYqRrh',
    });
    notify.onclick = function () {
    	parent.focus();
        window.focus();
        this.close();
      };
      
      try {
    	  notificationElement.play();
      } catch(e) {
    	  console.log("not able to play notification.");
      }
}

function notifyMe(message,body) {
    if (!window.Notification) {
        console.log('Browser does not support notifications.');
    } else {
        // check if permission is already granted
        if (Notification.permission === 'granted') {
            // show notification here
        	_notifyMe(message,body);
        } else {
            // request permission from user
            Notification.requestPermission().then(function (p) {
                if (p === 'granted') {
                    // show notification here
                	_notifyMe(message,body);

                } else {
                    console.log('User blocked notifications.');
                }
            }).catch(function (err) {
                console.error(err);
            });
        }
    }
}