define(["jquery", 'jqueryui', "jqueryform", "HeadCreator", "Common", "CloudCreator", "GalleryImageSelection","GalleryCloudImageSelection"], function($, jqueryui, jqueryform, HeadCreator, Common, CloudCreator, GalleryImageSelection, GalleryCloudImageSelection) 
{
	var FileUploader = function(){};
	var dialogOpts, file;
	var uploadFileName, uploadFilePath;
	var headCreator;
        var cloudCreator;
        var galleryImageSelection = null;
	galleryImageSelection = new GalleryImageSelection("galleryImageSelectionDiv");        
        var galleryCloudImageSelection = null;        
	$("#displayer").hide();
	
	dialogOpts = 
	{
		title: "Upload File",
		modal: true,
		autoOpen: false,
		height: 260,
		width: 550,
		buttons: 
		{
			'Upload a file': function() 
			{   
				//$("form").submit();
                                $('#fileUploadForm').submit();				
			},
                        'Use our image gallery': function() 
			{   
				
                                if(Common.getUploadCategory() == "head")
                                {
                                    galleryImageSelection.load();                                
                                }
                                else if(Common.getUploadCategory() == "cloud")
                                {
                                    if(galleryCloudImageSelection == null)
                                    {
                                        galleryCloudImageSelection = new GalleryCloudImageSelection("galleryCloudImageSelectionDiv");
                                    }
                                    galleryCloudImageSelection.load();                                
                                }
			},
			'Cancel': function() 
			{
				$(this).dialog('destroy');
			}
		},
		open: function() 
		{
			//display correct dialog content
			$("#file_browse").change(function()
			{
				file = this.files[0];
				$("#fileName").val(file.name);
			});
		}
	};
	
	$('#fileUploadForm').submit(function() { 
		// submit the form 
		$(this).ajaxSubmit(
		{
			beforeSubmit: function() 
			{
				var fileType = file.name.substring(file.name.lastIndexOf(".") + 1).toLowerCase();
				if( file.size / (1024 * 1024) > 3 || (fileType != "jpg" && fileType != "png"))
				{
					if(fileType != "jpg" && fileType != "png")
					{
						alert("File type is not jpg/png");
					}
					else if( (file.size / (1024 * 1024)) > 3)
					{
						alert("File size is larger that 3 MB.");
					}
					
					$("#fileName").val("");
					return false;
				}
				else
				{
					$("#displayer").show();
				}
			},
			success: function(resp) 
			{
				var result = JSON.parse(resp);
				if(result.success)
				{
					uploadFileName = result.fileName;
					uploadFilePath = result.uploadPath;
					//console.log(result.fileName);
					//console.log(result.uploadPath);
                                        if(Common.getUploadCategory() == "head")
                                        {
                                            headCreator = new HeadCreator("headCreatorDiv");
                                            headCreator.load(uploadFileName, uploadFilePath);
                                        }
                                        else if(Common.getUploadCategory() == "cloud")
                                        {
                                            cloudCreator = new CloudCreator("cloudCreatorDiv");
                                            cloudCreator.load(uploadFileName, uploadFilePath);
                                        }
				}
				else
				{
					alert("File cannot be save at this moment. Try again");
				}
				
				$("#displayer").hide();
				$("#fileName").val("");
                                $(this).dialog('destroy');
			}
		}); 
		return false; 
	});
	
	$("#fileUploaderDiv").dialog(dialogOpts);
	
	FileUploader.show = function()
	{
		$("#fileUploaderDiv").dialog(dialogOpts);
		$("#fileUploaderDiv").dialog("open");
	};

	return FileUploader;
});