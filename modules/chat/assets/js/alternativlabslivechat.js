

function createIframe() {
	var resizerScript = document.createElement("script");
	resizerScript.type="text/javascript";
	resizerScript.src=fwbaseurl+"modules/chat/assets/js/iframeResizer.min.js";
	document.head.appendChild(resizerScript);
	resizerScript.onload = function(event){
		var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below

		iFrameResize( {
			widthCalculationMethod: isOldIE ? 'max' : 'rightMostElement'
		});
	}
	
	var iframe = document.createElement("iframe");
	iframe.frameBorder=0;
	iframe.id="alternativlabschatbox";
	iframe.style.position="fixed";
	iframe.style.right=0;
	iframe.style.bottom=0;
	iframe.style.zIndex=9999999;
	iframe.width="250px";
	iframe.height="40px";
	iframe.setAttribute("marginheight","1");
	iframe.setAttribute("marginwidth","1");
	iframe.setAttribute("seamless","seamless");
	iframe.setAttribute("scrolling","no");
	iframe.setAttribute("allowtransparency","true");
	iframe.setAttribute("src",baseurl+"index.php?module=chat");
	document.body.appendChild(iframe);
	
}




function openchat() {
	var iframe = document.getElementById("alternativlabschatbox");
	iframe.height="340px";
	iframe.width="250px";
} 




function minimizechat() {
	var iframe = document.getElementById("alternativlabschatbox");
	iframe.height="40px";
	
}

function resetchat() {
	var iframe = document.getElementById("alternativlabschatbox");
	iframe.width="250px";
	iframe.height="40px";
	
}

function connectChatWindow() {
	var iframe = document.getElementById("alternativlabschatbox");
	iframe.width="370px";
	iframe.height="430px";
	
}

var chatFrameloadedBool  = false;
function setChatFrameLoaded(b) {
	chatFrameloadedBool = b;
}



function isChatFrameLoaded() {
	return chatFrameloadedBool;
}




window.onload = function() {
	createIframe();	
}




