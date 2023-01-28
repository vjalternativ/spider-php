var opt = {
		margin: [0,0],
		image: { type: 'jpeg', quality: 1 },
		html2canvas:  { dpi: 92, letterRendering: true ,imageTimeout: 0,scale:1},
		jsPDF: { unit: 'cm', format: 'letter', orientation: 'landscape' }
};
	
	
	
	
function downloadPDF(elementId,filename) {
	let element = document.getElementById(elementId);
	html2pdf().set(opt).from(element).save(filename);
}

function sendPDF(url,elementId,callback) {
	let element = document.getElementById(elementId);
	html2pdf().from(element).set(opt).toPdf().output('datauristring').then(function(pdfAsString) {
		// The PDF has been converted to a Data URI string and passed to this function.
		// Use pdfAsString however you like (send as email, etc)!

		var arr = pdfAsString.split(',');
		pdfAsString = arr[1];
		var data = new FormData();
		data.append("data", pdfAsString);
		var xhr = new XMLHttpRequest();
		xhr.open('post', url, true); //Post the Data URI to php Script to save to server
		xhr.send(data);
		if(callback) {
			callback();
		}
		
	});
}