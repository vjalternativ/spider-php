/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'modules/chunkuploader/server/php/index.php';
	    $('#importuploader').fileupload({
	        url: url,
	        maxChunkSize: 1000000,
	        dataType: 'json',
	        done: function (e, data) {
	            $.each(data.result.files, function (index, file) {
	                $('<p/>').text(file.name).appendTo('#files');
	            });
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        }
	    }).on('fileuploaddone', function (e, data) {
	        $.each(data.result.files, function (index, file) {
	            if (file.url) {
	            	
	            	console.log("UPLOADED");
	            	console.log(file); 
	            	var url = "index.php?module=page_component&action=import";
	            	var data = {importmodule:"page_component",filename:file.name,processmethod:"executeChunkImport","fname":"Import Page Component"};
	         			
	            	alert("uploaded successfully.");
		 	        	
	            	$.ajax({
	            		  type: 'POST',
	            		  url: url,
	            		  data: data,
	            		  async:false
	            		});
	            	
	            	
	                
	            	/*
	            	$.post(url,data,function(res){
	            		alert("uploaded successfully.");
	            	});*/
	            } else if (file.error) {
	                console.log("FILE UPLOAD FAILED");
	            }
	        });
	    }).on('fileuploadfail', function (e, data) {
	        $.each(data.files, function (index) {
	            var error = $('<span class="text-danger"/>').text('File upload failed.');
	            $(data.context.children()[index])
	                .append('<br>')
	                .append(error);
	        });
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	    
	    
	    
	    
	    $('#importbotdescuploader').fileupload({
	        url: url,
	        maxChunkSize: 1000000,
	        dataType: 'json',
	        done: function (e, data) {
	            $.each(data.result.files, function (index, file) {
	                $('<p/>').text(file.name).appendTo('#files');
	            });
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        }
	    }).on('fileuploaddone', function (e, data) {
	        $.each(data.result.files, function (index, file) {
	            if (file.url) {
	            	
	            	var position = $("#position").val();
	            	var url = "index.php?module=page_component&action=import";
	            	var data = {importmodule:"page_component",filename:file.name,processmethod:"executeChunkBotDescImport","fname":"Import Bottom Desc","position":position};
	            	
	            	$.ajax({
	            		  type: 'POST',
	            		  url: url,
	            		  data: data,
	            		  success : function(data) {
	            				alert("uploaded successfully.");
	            	      },
	            		  async:false
	            		});
	            	
	            	
	            	 
	            } else if (file.error) {
	                var error = $('<span class="text-danger"/>').text(file.error);
	                $(data.context.children()[index])
	                    .append('<br>')
	                    .append(error);
	            }
	        });
	    }).on('fileuploadfail', function (e, data) {
	        $.each(data.files, function (index) {
	            var error = $('<span class="text-danger"/>').text('File upload failed.');
	            $(data.context.children()[index])
	                .append('<br>')
	                .append(error);
	        });
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	    
});
