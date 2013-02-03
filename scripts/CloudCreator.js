define(["jquery", "Circle", "Square", "Common"], function($, Circle, Square, Common) 
{
	function CloudCreator(div)
	{
		var imageStartX, imageStartY;
		var rotateValue = 0, scaleSize = 1;
		var dragStartX = 0;
		var dragStartY = 0;
		var cloudCreatorDiv = $("#"+div );
		var cloudCreatorCanvas = cloudCreatorDiv.find("canvas")[0];
                var cloudCroppedCanvas = cloudCreatorDiv.find("canvas")[1];
		//var headCreatorCroppedImageCanvas = headCreatorDiv.find("canvas")[1];
		var cloudCreatorContext;
                var cloudCroppedContext;
		var selectionHeadShape;
                var cloudImage;
		
		var dialogOpts = 
		{
			title: "Prepare Your head",
			modal: true,
			autoOpen: false,
			height: 600,
			width: 550,
			buttons: 
			{
				'Save': function() 
				{   
                                    Common.setStep3(1);
                                    $("#buttonCreateCloudCheck").attr("style", "visibility: visible");
                                    
                                    cloudCroppedContext.putImageData(selectionHeadShape.getCroppedImage(), cloudImage.width/2-20 ,cloudImage.height/2-20);
                                    var imageData = cloudCroppedContext.getImageData(0,0, cloudImage.width, cloudImage.height);
                                    Common.saveImage(imageData, cloudCroppedContext, cloudImage, Common.get1xPath()+Common.getProjectId()+"/",'sprite-9-0',"3");    
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
		cloudCreatorDiv.dialog(dialogOpts);
		//set canvas height and width

		
		CloudCreator.prototype.load = function( imageName, imagePath )
		{
			//the image that will be edited
			var headImage = new Image();
                        cloudImage = new Image();
                        var cloudImagePath = "../templates/"+Common.getTemplateId()+"/assets/graphics/1x/"+Common.getProjectId()+"/sprite-9-0.png";
                        cloudCreatorDiv.dialog(dialogOpts);
			cloudCreatorDiv.dialog("open");
			if(cloudCroppedCanvas.getContext)
			{
				cloudCroppedContext = cloudCroppedCanvas.getContext("2d");
				cloudImage.onload = function()				
                                {
                                    cloudCroppedContext.canvas.height = cloudImage.height;
                                    cloudCroppedContext.canvas.width = cloudImage.width;
                                    cloudCroppedContext.drawImage(cloudImage, 0, 0, cloudImage.width, cloudImage.height);
					
				};				
				//set the image
				cloudImage.src = cloudImagePath+"?"+new Date().getTime();				
			}
			if(cloudCreatorCanvas.getContext)
			{
				cloudCreatorContext = cloudCreatorCanvas.getContext("2d");
				//headCreatorCroppedImageContext = headCreatorCroppedImageCanvas.getContext("2d");
				if(Common.getTemplateId() == "1")
				{
					selectionHeadShape = new Circle(cloudCreatorContext);
				}
				else if(Common.getTemplateId() == "2")
				{
					selectionHeadShape = new Square(cloudCreatorContext);
				}
				
				
				headImage.onload = function()
				{
					//set the image start position x and y pos
					imageStartX = cloudCreatorCanvas.width / 2 - headImage.width / 2;
					imageStartY = cloudCreatorCanvas.height / 2 - headImage.height / 2;
					
					//canvasdrawing function is called every 10 milli seconds
					interval = setInterval (function()
					{
						//clear the whole canvas
						cloudCreatorContext.clearRect(0,0, cloudCreatorCanvas.width, cloudCreatorCanvas.height);
						//get the default canvas
						cloudCreatorContext.save();
						cloudCreatorContext.translate(cloudCreatorCanvas.width/2, cloudCreatorCanvas.height/2);
						//rotate if needed
						cloudCreatorContext.rotate(rotateValue*(Math.PI/180));
						//scale if needed
						cloudCreatorContext.scale(scaleSize, scaleSize);
						cloudCreatorContext.translate(-cloudCreatorCanvas.width/2,-cloudCreatorCanvas.height/2);
						//drawing the images
						cloudCreatorContext.drawImage(headImage, imageStartX, imageStartY, headImage.width, headImage.height);
						//canvasContext.translate(-50,-50);
						//restore the canvas
						cloudCreatorContext.restore();
						
						//draw the selection object
						if(selectionHeadShape)
							selectionHeadShape.draw();
						
					}, 10);
				};
				
				//set the image
				headImage.src = "../"+imagePath + imageName;
				
				$("#"+cloudCreatorCanvas.id).mousemove(function(event)
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
				$("#"+cloudCreatorCanvas.id).mousedown(function(event)
				{
					//calulate drag postion when mous is pressed
					dragStartX = event.pageX;
					dragStartY = event.pageY;
				});
				$("#"+cloudCreatorCanvas.id).mouseup(function(event)
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
	return CloudCreator;
});