define(["jquery", "Common", "FileUploader"], function($, Common, FileUploader) 
{
	
	function TextCreator(div)
	{
		var imageStartX, imageStartY;
		var textCreatorDiv = $("#"+div );
		var textCreatorCanvas = textCreatorDiv.find("canvas")[0];
		var textCreatorContext;
		var selectionHeadShape;
		var textImage = new Image();
		
		var dialogOpts = 
		{
			title: "Prepare Your Text",
			modal: true,
			autoOpen: false,
			height: 410,
			width: 400,
			buttons: 
			{
				'Cancel': function() 
				{
					$(this).dialog('destroy');
				}
				,
				'Continue': function() 
				{
					var from = document.getElementById("fromText").value;
					var to = document.getElementById("toText").value;
                                        var message = document.getElementById("messageText").value;
                                        
                                        Common.setMessage(message);
                                        
					//resetting the canvas
					textCreatorCanvas.width = textImage.width;
					textCreatorCanvas.height = textImage.height;
					//drawing original image first
					textCreatorContext.drawImage(textImage, 0, 0, textImage.width, textImage.height);					
					//adding the text
					textCreatorContext.font = "11px sans-serif";
					textCreatorContext.fillStyle = "#00FF00";
					textCreatorContext.fillText(from, 40, 18);
					textCreatorContext.fillText(to, 40, 33);
					
					var imageData = textCreatorContext.getImageData(0,0, textCreatorCanvas.width, textCreatorCanvas.height);
					Common.saveImage(imageData, textCreatorContext, imageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-26-0', message);
					
					$(this).dialog('destroy');
					
                                        Common.setUploadCategory("head");
                                        FileUploader.show();
				}
			},
			open: function() 
			{
				//resetting previous text
				$("#fromText").val("");
				$("#toText").val("");
				$("#messageText").val("");
			}
		};
		textCreatorDiv.dialog(dialogOpts);
		
		TextCreator.prototype.load = function( imageName, imagePath )
		{
			textCreatorDiv.dialog(dialogOpts);
			textCreatorDiv.dialog("open");
			if(textCreatorCanvas.getContext)
			{
				textCreatorContext = textCreatorCanvas.getContext("2d")				
				textImage.onload = function()
				{
					//set the image start position x and y pos
					imageStartX = 0;
					imageStartY = 0;
					
					textCreatorContext.drawImage(textImage, imageStartX, imageStartY, textImage.width, textImage.height);
				};				
				//set the image
				textImage.src = "../../"+imagePath + imageName;	
			}
		};		
	};
	return TextCreator;
});