define(["jquery"], function($){
    var Common = function(){};
    var base_url;
    var project_id;
    var template_id;
    var publish_code;
    var upload_category;
    var from = "";
    var to = "";
    var message = "";  
    var step1 = 0;
    var step2 = 0;
    var step3 = 0;
    var total_head_images = 0;
    var total_cloud_images = 0;
    var gallery_selected_image_name = "";
    Common.setTransparency = function(canvasContext, transparency)
    {
        canvasContext.save();
        canvasContext.fillStyle = "rgba(255, 255, 255," + transparency+" )";
        //canvasContext.globalCompositeOperation = "lighter";
        //canvasContext.globalAlpha = parseInt(transparency);
        canvasContext.rect(0,0, canvasContext.canvas.width, canvasContext.canvas.height);
        canvasContext.fill();
        canvasContext.restore();
    };

    Common.saveImage = function(croppedImage, savedImageCanvas, imageData, imagePath, imageName, stepId)
    {
        var croppedImageCanvas = document.getElementById("croppedImageCanvas");
        var croppedImageCanvasContext = croppedImageCanvas.getContext('2d');
		
        /*var tempCanvasContext = savedImageCanvas;
		tempCanvasContext.canvas.height = croppedImage.height;
		tempCanvasContext.canvas.width = croppedImage.width;
		tempCanvasContext.putImageData(croppedImage, 0 ,0);*/
		
        croppedImageCanvasContext.canvas.height = croppedImage.height;
        croppedImageCanvasContext.canvas.width = croppedImage.width;
        croppedImageCanvasContext.putImageData(croppedImage, 0 ,0);
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            /*var div = $("#balloonslist");
                                var ul = $("ul", div);
                                var li = $("li", ul);
                                li.each(function()
                                {
                                    var image = $("img", this)[0];   
                                    if(image.src.indexOf(imageName) >= 0)
                                    {
                                        image.src = "../."+Common.get1xPath()+Common.getProjectId()+"/"+imageName+".png?"+new Date().getTime();
                                    }
                                });
                                console.log("completed");*/
            }
        }
        xmlhttp.open("POST","save/",true);
        var multipart ="";

        var boundary = Math.random().toString().substr(2);
        //var data = tempCanvasContext.canvas.toDataURL("image/png")
        var data = croppedImageCanvasContext.canvas.toDataURL("image/png");
        xmlhttp.setRequestHeader("content-type",
            "multipart/form-data; charset=utf-8; boundary=" + boundary);

        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=data"
        + "\r\nContent-type: image/jpeg"
        + "\r\n\r\n" + data + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
	
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=imageNname"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + imageName + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
		
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=imagePath"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + imagePath + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
                
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=message"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + message + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
                
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=from"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + from + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
                
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=to"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + to + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
        
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=step_id"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + stepId + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
                
        multipart += "--" + boundary
        + "\r\nContent-Disposition: form-data; name=project_id"
        + "\r\nContent-type: text"
        + "\r\n\r\n" + project_id + "\r\n";
		
        multipart += "--"+boundary+"--\r\n";
		
        xmlhttp.send(multipart);
    };
	
    Common.setPublishCode = function(publishCode)
    {
        publish_code = publishCode;
    }
	
    Common.getPublishCode = function()
    {
        return publish_code;
    }
        
    Common.setProjectId = function(id)
    {
        project_id = id;
    }
	
    Common.getProjectId = function()
    {
        return project_id;
    }
	
    Common.setTemplateId = function(templateId)
    {
        template_id = templateId;
    }
	
    Common.getTemplateId = function()
    {
        return template_id;
    }
        
    Common.get1xPath = function()
    {
        return "./templates/"+Common.getTemplateId()+"/assets/graphics/1x/";
    }
    Common.get2xPath = function()
    {
        return "./templates/"+Common.getTemplateId()+"/assets/graphics/2x/";
    }
    Common.get4xPath = function()
    {
        return "./templates/"+Common.getTemplateId()+"/assets/graphics/4x/";
    }
    Common.setUploadCategory = function(id)
    {
        upload_category = id;
    }
	
    Common.getUploadCategory = function()
    {
        return upload_category;
    }
    Common.setMessage = function(id)
    {
        message = id;
    }
	
    Common.getMessage = function()
    {
        return message;
    }
    Common.setFrom = function(id)
    {
        from = id;
    }
	
    Common.getFrom = function()
    {
        return from;
    }
    Common.setTo = function(id)
    {
        to = id;
    }
	
    Common.getTo = function()
    {
        return to;
    }
    Common.setBaseUrl = function(id)
    {
        base_url = id;
    }
	
    Common.getBaseUrl = function()
    {
        return base_url;
    }
    Common.setStep1 = function(id)
    {
        step1 = id;
    }
	
    Common.getStep1 = function()
    {
        return step1;
    }
    Common.setStep2 = function(id)
    {
        step2 = id;
    }
	
    Common.getStep2 = function()
    {
        return step2;
    }
    Common.setStep3 = function(id)
    {
        step3 = id;
    }
	
    Common.getStep3 = function()
    {
        return step3;
    }
    Common.setTotalHeadImages = function(id)
    {
        total_head_images = id;
    }
	
    Common.getTotalHeadImages = function()
    {
        return total_head_images;
    }
    Common.setTotalCloudImages = function(id)
    {
        total_cloud_images = id;
    }
	
    Common.getTotalCloudImages = function()
    {
        return total_cloud_images;
    }
    Common.setGallerySelectedName = function(id)
    {
        gallery_selected_image_name = id;
    }
	
    Common.getGallerySelectedName = function()
    {
        return gallery_selected_image_name;
    }
    return Common;
});