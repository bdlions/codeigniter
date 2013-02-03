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
            var head1CroppedCanvas = headCreatorDiv.find("canvas")[1];
            var head2CroppedCanvas = headCreatorDiv.find("canvas")[2];
            var head3CroppedCanvas = headCreatorDiv.find("canvas")[3];
            var headCreatorContext;
            var head1CroppedContext;
            var head2CroppedContext;
            var head3CroppedContext;
            var selectionHeadShape;
            var head1CroppedImage;
            var head2CroppedImage;
            var head3CroppedImage;
            var dialogOpts = 
            {
                title: "Prepare Your head",
                modal: true,
                autoOpen: false,
                height: 520,
                width: 550,
                buttons: 
                {
                    'Save': function() 
                    {   
                        Common.setStep2(1);
                        $("#buttonCreateHeadCheck").attr("style", "visibility: visible");
                        
                        var imageData = headCreatorContext.getImageData(0,0, headCreatorCanvas.width, headCreatorCanvas.height);				
					
                        var selectedImage = $('input[name=image]:checked').val();
                        if(selectedImage == "redballoon")
                        {
                            head1CroppedContext.putImageData(selectionHeadShape.getCroppedImage(), head1CroppedImage.width/2-20 ,head1CroppedImage.height/2-20);
                            var head1CroppedImageData = head1CroppedContext.getImageData(0,0, head1CroppedImage.width, head1CroppedImage.height);
                                    
                            Common.saveImage(selectionHeadShape.getCroppedImage(), headCreatorContext, head1CroppedImageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-3-0',"2");
                        //headCreatorCroppedImageContext.putImageData(selectionHeadShape.getCroppedImage(), 0, 0);
                        }
                        else if(selectedImage == "yellowballoon")
                        {
                            head2CroppedContext.putImageData(selectionHeadShape.getCroppedImage(), head2CroppedImage.width/2-20 ,head2CroppedImage.height/2-20);
                            var head2CroppedImageData = head2CroppedContext.getImageData(0,0, head2CroppedImage.width, head2CroppedImage.height);
                            
                            Common.saveImage(selectionHeadShape.getCroppedImage(), headCreatorContext, head2CroppedImageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-5-0',"2");
                        //headCreatorCroppedImageContext.putImageData(selectionHeadShape.getCroppedImage(), 100, 0);
                        }
                        else if(selectedImage == "greenballon")
                        {
                            head3CroppedContext.putImageData(selectionHeadShape.getCroppedImage(), head3CroppedImage.width/2-20 ,head3CroppedImage.height/2-20);
                            var head3CroppedImageData = head3CroppedContext.getImageData(0,0, head3CroppedImage.width, head3CroppedImage.height);
                           
                            Common.saveImage(selectionHeadShape.getCroppedImage(), headCreatorContext, head3CroppedImageData, Common.get1xPath()+Common.getProjectId()+"/",'sprite-16-0',"2");
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
		
                head1CroppedImage = new Image();
                var head1CroppedPath = "../templates/"+Common.getTemplateId()+"/assets/graphics/1x/"+Common.getProjectId()+"/sprite-3-0.png";
                if(head1CroppedCanvas.getContext)
                {
                        head1CroppedContext = head1CroppedCanvas.getContext("2d");
                        head1CroppedImage.onload = function()				
                        {
                            head1CroppedContext.canvas.height = head1CroppedImage.height;
                            head1CroppedContext.canvas.width = head1CroppedImage.width;
                            head1CroppedContext.drawImage(head1CroppedImage, 0, 0, head1CroppedImage.width, head1CroppedImage.height);

                        };				
                        //set the image
                        head1CroppedImage.src = head1CroppedPath+"?"+new Date().getTime();				
                }
                
                head2CroppedImage = new Image();
                var head2CroppedPath = "../templates/"+Common.getTemplateId()+"/assets/graphics/1x/"+Common.getProjectId()+"/sprite-5-0.png";
                if(head2CroppedCanvas.getContext)
                {
                        head2CroppedContext = head2CroppedCanvas.getContext("2d");
                        head2CroppedImage.onload = function()				
                        {
                            head2CroppedContext.canvas.height = head2CroppedImage.height;
                            head2CroppedContext.canvas.width = head2CroppedImage.width;
                            head2CroppedContext.drawImage(head2CroppedImage, 0, 0, head2CroppedImage.width, head2CroppedImage.height);

                        };				
                        //set the image
                        head2CroppedImage.src = head2CroppedPath+"?"+new Date().getTime();				
                }
                
                head3CroppedImage = new Image();
                var head3CroppedPath = "../templates/"+Common.getTemplateId()+"/assets/graphics/1x/"+Common.getProjectId()+"/sprite-16-0.png";
                if(head3CroppedCanvas.getContext)
                {
                        head3CroppedContext = head3CroppedCanvas.getContext("2d");
                        head3CroppedImage.onload = function()				
                        {
                            head3CroppedContext.canvas.height = head3CroppedImage.height;
                            head3CroppedContext.canvas.width = head3CroppedImage.width;
                            head3CroppedContext.drawImage(head3CroppedImage, 0, 0, head3CroppedImage.width, head3CroppedImage.height);

                        };				
                        //set the image
                        head3CroppedImage.src = head3CroppedPath+"?"+new Date().getTime();				
                }
                
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
                    headImage.src = "../"+imagePath + imageName;
				
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