$(document).ready(function(){
	var url = "./index.php?module=chatroom&action=pullNotification";
	
	looprequest(url,{},3000,function(res){
		var response = JSON.parse(res);
		if(response.status=="success") {
			if(response.data.count >0) {
				var msg = response.data.count + " New Chat Request Recieved.";
				notifyMe(msg,"");
			}
		}
	},function(){
		return true;
	});
	
	
});

