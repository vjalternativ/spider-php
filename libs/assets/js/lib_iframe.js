var lib_iframe =  {
		
		resizerScript : null,
		
		initResizerScript : function() {
			
			if(lib_iframe.resizerScript==null) {
			
				loadScript(fwbaseurl+"resources/backend/modules/chat/assets/js/iframeResizer.min.js",function(){
					var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below

					iFrameResize( {
						widthCalculationMethod: isOldIE ? 'max' : 'rightMostElement'
					});
					
					resizerScript = "Loaded";
					
				});
				
			}
			
			
			
		},


		
		createIFrame : function(id,url,options) {
			
			lib_iframe.initResizerScript();
			var defaultOptions = {
					width:200,
					height:200,
					display:"block"
			};
			
			options.width = options.hasOwnProperty("width") ? options.width : defaultOptions.width;
			options.height = options.hasOwnProperty("height") ? options.height : defaultOptions.height;
			options.display = options.hasOwnProperty("display") ? options.display : defaultOptions.display;
			
			var iframe = document.createElement("iframe");
			iframe.frameBorder=0;
			iframe.id=options.id;
			iframe.style.position="fixed";
			iframe.style.right=0;
			iframe.style.bottom=0;
			iframe.style.zIndex=9999999;
			iframe.style.display = options.display; 
			iframe.width=options.width+"px";
			iframe.height=options.height+"px";
			iframe.setAttribute("marginheight","1");
			iframe.setAttribute("marginwidth","1");
			iframe.setAttribute("seamless","seamless");
			iframe.setAttribute("scrolling","no");
			iframe.setAttribute("allowtransparency","true");
			iframe.setAttribute("allow","autoplay");
			iframe.setAttribute("src",url);
			document.body.appendChild(iframe);
			return iframe;
		}
}

