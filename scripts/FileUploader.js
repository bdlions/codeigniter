define(["jquery", 'jqueryui', "jqueryform", "HeadCreator", "Common", "CloudCreator"], function($, jqueryui, jqueryform, HeadCreator, Common, CloudCreator) 
{
	var FileUploader = function(){};
	var dialogOpts, file;
	var uploadFileName, uploadFilePath;
	var headCreator;
        var cloudCreator;
		
	$("#displayer").hide();
	
	dialogOpts = 
	{
		title: "Upload File",
		modal: true,
		autoOpen: false,
		height: 260,
		width: 400,
		buttons: 
		{
			'Upload': function() 
			{   
				//$("form").submit();
                                $('#fileUploadForm').submit();
				$(this).dialog('destroy');
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
				var fileType = file.name.substring(file.name.lastIndexOf(".") + 1);
				if( file.size / (1024 * 1024) > 3 || fileType != "jpg")
				{
					if(fileType != "jpg")
					{
						alert("File type is not jpg");
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