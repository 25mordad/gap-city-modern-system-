<link rel="stylesheet" href="{$loct}/css/browse.css" />
{literal}
<script>
$(document).ready(function() {
	
	// Makes sure the dataTransfer information is sent when we
	// Drop the item in the drop box.
	jQuery.event.props.push('dataTransfer');
	
	var z = -40;
	// The number of images to display
	var maxFiles = 6;
	var errMessage = 0;
	
	// Get all of the data URIs and put them in an array
	var dataArray = [];
	
	// Bind the drop event to the dropzone.
	$('#drop-files').bind('drop', function(e) {
			
		// Stop the default action, which is to redirect the page
		// To the dropped file
		
		var files = e.dataTransfer.files;
		
		// Show the upload holder
		$('#uploaded-holder').show();
		
		// For each file
		$.each(files, function(index, file) {

			{/literal}{if $part eq "workbook"}{literal}
				if (!(files[index].name.toLowerCase().match('.*\.(jpg|jpeg|png|gif|pdf|doc|docx|txt)'))) {
					
					$('#drop-files').html('فایل غیرمجاز!');
					return false;
				}
				else
				{
					$('#drop-files').html('فایل‌های مورد نظر را اینجا رها کنید');
				}
			{/literal}{else if $part eq "sound"}{literal}
				if (!(files[index].name.toLowerCase().match('.*\.(mp3)'))) {
						
					$('#drop-files').html('فایل غیرمجاز!');
					return false;
				}
				else
				{
					$('#drop-files').html('فایل‌های مورد نظر را اینجا رها کنید');
				}
			{/literal}{else}{literal}
				// Some error messaging
				if (!(files[index].type.match('image.*') && files[index].name.toLowerCase().match('.*\.(jpg|jpeg|png|gif)'))) {
					
					if(errMessage == 0) {
						$('#drop-files').html('لطفا فقط فایل‌های تصویری را اینجا رها کنید');
						++errMessage
					}
					else if(errMessage == 1) {
						$('#drop-files').html('فقط فایل‌های تصویری');
						++errMessage
					}
					else if(errMessage == 2) {
						$('#drop-files').html("فقط فایل‌های تصویری!");
						++errMessage
					}
					else if(errMessage == 3) {
						$('#drop-files').html("فقط فایل‌های تصویری!!");
						errMessage = 0;
					}
					return false;
				}
				else
				{
					$('#drop-files').html('فایل‌های مورد نظر را اینجا رها کنید');
				}
			{/literal}{/if}{literal}

			
			// Check length of the total image elements
			
			if($('#dropped-files > .image').length < maxFiles) {
				// Change position of the upload button so it is centered
				var imageWidths = ((220 + (40 * $('#dropped-files > .image').length)) / 2) - 20;
				$('#upload-button').css({'left' : imageWidths+'px', 'display' : 'block'});
			}
			
			// Start a new instance of FileReader
			var fileReader = new FileReader();
				
				// When the filereader loads initiate a function
				fileReader.onload = (function(file) {
					
					return function(e) { 
						
						// Push the data URI into an array
						dataArray.push({{/literal}name : file.name, value : this.result, part: "{$part}", id: "{${$part}->id}"{literal}});
						
						// Move each image 40 more pixels across
						z = z+40;
						var image = this.result;
						
						
						// Just some grammatical adjustments
						if(dataArray.length == 1) {
							$('#upload-button span').html("یک فایل در انتظار آپلود است");
						} else {
							$('#upload-button span').html(dataArray.length+" فایل در انتظار آپلود هستند");
						}
						// Place extra files in a list
						if($('#dropped-files > .image').length < maxFiles) { 
							// Place the image inside the dropzone
							$('#dropped-files').append('<div class="image" style="left: '+z+'px; background: url('+image+'); background-size: cover;"> </div>'); 
						}
						else {
							
							$('#extra-files .number').html('+'+($('#file-list li').length + 1));
							// Show the extra files dialogue
							$('#extra-files').show();
							
							// Start adding the file name to the file list
							$('#extra-files #file-list ul').append('<li>'+file.name+'</li>');
							
						}
					}; 
					
				})(files[index]);
				
			// For data URI purposes
			fileReader.readAsDataURL(file);
	
		});
		

	});
	
	function restartFiles() {
	
		// This is to set the loading bar back to its default state
		$('#loading-bar .loading-color').css({'width' : '0%'});
		$('#loading').css({'display' : 'none'});
		$('#loading-content').html(' ');
		// --------------------------------------------------------
		
		// We need to remove all the images and li elements as
		// appropriate. We'll also make the upload button disappear
		
		$('#upload-button').hide();
		$('#dropped-files > .image').remove();
		$('#extra-files #file-list li').remove();
		$('#extra-files').hide();
		$('#uploaded-holder').hide();
	
		// And finally, empty the array/set z to -40
		dataArray.length = 0;
		z = -40;
		
		return false;
	}
	
	$('#upload-button .upload').click(function() {
		
		$("#loading").show();
		var totalPercent = 100 / dataArray.length;
		var x = 0;
		var y = 0;
		
		$('#loading-content').html('در حال آپلود '+dataArray[0].name);
		
		$.each(dataArray, function(index, file) {	
			
			$.post(document.URL+ "/AjaxController?controller=upload_image", dataArray[index], function(data) {
			
				var fileName = dataArray[index].name;
				++x;
				
				// Change the bar to represent how much has loaded
				$('#loading-bar .loading-color').css({'width' : totalPercent*(x)+'%'});
				
				if(totalPercent*(x) == 100) {
					// Show the upload is complete
					$('#loading-content').html('آپلود به پایان رسید!');
					
					// Reset everything when the loading is completed
					setTimeout(restartFiles, 500);
					
				} else if(totalPercent*(x) < 100) {
				
					// Show that the files are uploading
					$('#loading-content').html('در حال آپلود '+fileName);
				
				}
				
				// Show a message showing the file URL.
				/* var dataSplit = data.split(':');
				if(dataSplit[1] == 'uploaded successfully') {
					var realData = '<li><a href="/uploads/'+dataSplit[0]+'">'+fileName+'</a> '+dataSplit[1]+'</li>';
					
					$('#uploaded-files').append('<li><a href="/uploads/'+dataSplit[0]+'">'+fileName+'</a> '+dataSplit[1]+'</li>');
				
					// Add things to local storage 
					if(window.localStorage.length == 0) {
						y = 0;
					} else {
						y = window.localStorage.length;
					}
					
					window.localStorage.setItem(y, realData);
				
				} else {
					$('#uploaded-files').append('<li><a href="/uploads/'+data+'. File Name: '+dataArray[index].name+'</li>');
				}*/
				$("#message").html(data);
				show_images();
				
			});
		});
		
		return false;
	});
	
	// Just some styling for the drop file container.
	$('#drop-files').bind('dragenter', function() {
		$(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed #bb2b2b'});
		return false;
	});
	
	$('#drop-files').bind('drop', function() {
		$(this).css({'box-shadow' : 'none', 'border' : '4px dashed rgba(0,0,0,0.2)'});
		return false;
	});
	
	// For the file list
	$('#extra-files .number').toggle(function() {
		$('#file-list').show();
	}, function() {
		$('#file-list').hide();
	});
	
	$('#dropped-files #upload-button .delete').click(restartFiles);
	
	// Append the localstorage the the uploaded files section
	/* if(window.localStorage.length > 0) {
		$('#uploaded-files').show();
		for (var t = 0; t < window.localStorage.length; t++) {
			var key = window.localStorage.key(t);
			var value = window.localStorage[key];
			// Append the list items
			if(value != undefined || value != '') {
				$('#uploaded-files').append(value);
			}
		}
	} else {
		$('#uploaded-files').hide();
	} */
});
</script>
{/literal}
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">انتخاب {if $part eq "workbook"}فایل{else if $part eq "sound"}فایل صوتی{else}تصویر{/if}</div>
                    <img src="{$loct}/images/icon/img.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                <div class="shakhes_brows">
		                	<div class="txt">
		                
						    <div id="drop-files" ondragover="return false">
								فایل‌های مورد نظر را اینجا رها کنید
							</div>
							
							<div id="uploaded-holder">
								<div id="dropped-files">
									<div id="upload-button">
										<a href="#" class="upload">آپــلــود</a>
										<a href="#" class="delete">حذف</a>
										<span>0 فایل</span>
									</div>
								</div>
								<div id="extra-files">
									<div class="number">
										0
									</div>
									<div id="file-list">
										<ul></ul>
									</div>
								</div>
							</div>
							
							<div id="loading">
								<div id="loading-bar">
									<div class="loading-color"> </div>
								</div>
								<div id="loading-content">در حال آپلود</div>
							</div>
							
		                	</div>
		                </div>
		                <div class="clear"></div>
		                <div class="show_pics" >
		                <div class="txt">
			                <script>
							function show_images()
							{ 
							    $.post(document.URL+ "/AjaxController?controller=get_images", { part: "{$part}", id: "{${$part}->id}" }, function(data,status){
							      $("#showimages").html(data);
							    }); 
							}
							function del_image(id)
							{ 
							    $.post(document.URL+ "/AjaxController?controller=del_image", { part: "{$part}", id: id }, function(data,status){							      
							    }); 
							}
							show_images();
							</script>
			                <div class="message" id="message" style="color:red;" >
			                </div>
			                <div class="showimages" id="showimages" >
			                </div>			                
		                </div>
		                </div>
		                <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->