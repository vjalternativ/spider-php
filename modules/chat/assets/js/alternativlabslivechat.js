

function createIframe() {
	
	var resizerScript = document.createElement("script");
	resizerScript.type="text/javascript";
	resizerScript.src=baseurl+"modules/chat/assets/js/iframeResizer.min.js";
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
	iframe.setAttribute("src","index.php?module=chat");
	
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
	iframe.width="400px";
	iframe.height="430px";
	
}


window.onload = function() {

	
	createIframe();
	
}


