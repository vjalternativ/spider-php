Logger = {};

Logger.log = function(type,message,data) {
	console.log(type + " : " message);
}

Logger.warn = function(message,data = null) {
	Logger.log("WARN",message,data);
}