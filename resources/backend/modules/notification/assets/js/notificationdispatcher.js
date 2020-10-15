var lastNotificationId = null;

function checkNotificatonStorage(e) {
	var notificationData = localStorage.getItem("notificationData_"+resource);
	var notificationOb = JSON.parse(notificationData);
	var payload = notificationOb.payload;
	if(notificationOb.id != lastNotificationId) {
		lastNotificationId = notificationOb.id;
		for(var i=0;i<payload.length;i++) {
			var notification = payload[i];
			var notificationEvent = notification.subtype + "Event";
			console.log("dispatching event ",notificationEvent);
			window.dispatchEvent(new CustomEvent(notificationEvent,{detail:notification.data}));	
			
		}
		
	}
}

$(document).ready(function(){
	window.addEventListener("storage", checkNotificatonStorage,false);
});


