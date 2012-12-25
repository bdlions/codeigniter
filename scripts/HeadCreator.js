define(["jquery", "Circle", "Square", "Common"], function($, Circle, Square, Common) 
{
	function HeadCreator(div)
	{
		var imageStartX, imageStartY;
		var rotateValue = 0, scaleSize = 1;
		var dragStartX = 0;
		var dragStartY = 0;
		var headCreatorDiv = $("#"+div );
		var headCreatorCanvas = headCreatorDiv.find("canvas")[0];
		//var headCreatorCroppedImageCanvas = headCreatorDiv.find("canvas")[1];
		var headCreatorContext;
		var selectionHeadShape;
		
		var dialogOpts = 
		{
			title: "Prepare Your head",
			modal: true,
			autoOpen: false,
			height: 450,
			width: 550,
			buttons: 
			{
				'Save': function() 
				{   
					var imageData = headCreatorContext.getImageData(0,0, headCreatorCanvas.width, headCreatorCanvas.height);				
					
					var selectedImage = $('input[name=image]:checked').val();
					if(selectedImage == "redballoon")
					{
						Common.saveImage(selectionHeadShape.getCroppedImage(), headCreatorContext, imageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-3-0',"");
						//headCreatorCroppedImageContext.putImageData(selectionHeadShape.getCroppedImage(), 0, 0);
					}
					else if(selectedImage == "yellowballoon")
					{
						Common.saveImage(selectionHeadShape.getCroppedImage(), headCreatorContext, imageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-5-0',"");
						//headCreatorCroppedImageContext.putImageData(selectionHeadShape.getCroppedImage(), 100, 0);
					}
					else if(selectedImage == "greenballon")
					{
						Common.saveImage(selectionHeadShape.getCroppedImage(), headCreatorContext, imageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-16-0',"");
						//headCreatorCroppedImageContext.putImageData(selectionHeadShape.getCroppedImage(), 200, 0);
					}					
                                        //clearInterval(interval);
					//$(this).dialog('destroy');
                                        
				},
				'Close': function() 
				{
                                        clearInterval(interval);
					$(this).dialog('destroy');
				}
			},
			open: function() 
			{
                            
			},                        
                        close: function()
                        {
                           clearInterval(interval);          
                        }
		};
		headCreatorDiv.dialog(dialogOpts);
		//set canvas height and width

		
		HeadCreator.prototype.load = function( imageName, imagePath )
		{
			//the image that will be edited
			var headImage = new Image();
			headCreatorDiv.dialog(dialogOpts);
			headCreatorDiv.dialog("open");
			
			if(headCreatorCanvas.getContext)
			{
				headCreatorContext = headCreatorCanvas.getContext("2d");
				//headCreatorCroppedImageContext = headCreatorCroppedImageCanvas.getContext("2d");
				if(Common.getTemplateId() == "1")
				{
					selectionHeadShape = new Circle(headCreatorContext);
				}
				else if(Common.getTemplateId() == "2")
				{
					selectionHeadShape = new Square(headCreatorContext);
				}
				
				
				headImage.onload = function()
				{
					//set the image start position x and y pos
					imageStartX = headCreatorCanvas.width / 2 - headImage.width / 2;
					imageStartY = headCreatorCanvas.height / 2 - headImage.height / 2;
					
					//canvasdrawing function is called every 10 milli seconds
					interval = setInterval (function()
					{
						//clear the whole canvas
						headCreatorContext.clearRect(0,0, headCreatorCanvas.width, headCreatorCanvas.height);
						//get the default canvas
						headCreatorContext.save();
						headCreatorContext.translate(headCreatorCanvas.width/2, headCreatorCanvas.height/2);
						//rotate if needed
						headCreatorContext.rotate(rotateValue*(Math.PI/180));
						//scale if needed
						headCreatorContext.scale(scaleSize, scaleSize);
						headCreatorContext.translate(-headCreatorCanvas.width/2,-headCreatorCanvas.height/2);
						//drawing the images
						headCreatorContext.drawImage(headImage, imageStartX, imageStartY, headImage.width, headImage.height);
						//canvasContext.translate(-50,-50);
						//restore the canvas
						headCreatorContext.restore();
						
						//draw the selection object
						if(selectionHeadShape)
							selectionHeadShape.draw();
						
					}, 10);
				};
				
				//set the image
				headImage.src = "../../"+imagePath + imageName;
				
				$("#"+headCreatorCanvas.id).mousemove(function(event)
				{
					if(dragStartX > 0)
					{
						//calculate the new image start positoin
						
						imageStartX -= dragStartX - event.pageX;
						imageStartY -= dragStartY - event.pageY;
						
						//calculate new drag posiont
						dragStartX = event.pageX;
						dragStartY = event.pageY;
						
					}
				});
				$("#"+headCreatorCanvas.id).mousedown(function(event)
				{
					//calulate drag postion when mous is pressed
					dragStartX = event.pageX;
					dragStartY = event.pageY;
				});
				$("#"+headCreatorCanvas.id).mouseup(function(event)
				{
					//when mouse is up then recalculate the drag pos
					dragStartX = 0;
					dragStartY = 0;
				});
				$("#buttonClockwiseRotation").click(function(event)
				{
					rotateValue += 5;
				});
				$("#buttonAntiClockwiseRotation").click(function(event)
				{
					rotateValue -= 5;
				});
				$("#buttonZoomIn").click(function(event)
				{
					if(scaleSize > 30)
					{ 
						scaleSize = scaleSize;
					}
					else 
					{
						scaleSize += .1;
					}
				});
				$("#buttonZoomOut").click(function(event)
				{
					if(scaleSize < .15)
					{ 
						scaleSize = scaleSize;
					}
					else 
					{
						scaleSize -= .1;
					}					
				});
			}
		};
		
	};
	return HeadCreator;
});