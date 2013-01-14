/*require(["jquery", "headshowcase", "FileUploader", "HeadCreator"], function($, headshowcase, FileUploader) {
    $(function() {
		headshowcase.init("headshowcase");	
		//headshowcase.setWorkspace();
		var fileUploader = new FileUploader("fileUploaderDiv");

		$("#buttonCreateHead").click(function()
		{
			fileUploader.show();
		});
    });
});*/
require(["jquery", "Common", "TextCreator", "headshowcase", "FileUploader","Login"], function($, Common, TextCreator, headshowcase, FileUploader, Login) {
    
    $(function() {		
        function isBrowserCanvasCompatible()
        {
            var canvas = document.createElement("canvas");
            return !!canvas.getContext&&!!canvas.getContext("2d");
        };
        if(!isBrowserCanvasCompatible())
        {
            window.location.href = "../../templates/redirect_path";
        }
        
        var liCounter = 1;
        $("li", $("#main_nav")).each(function ()
        {
            if(liCounter == 1)
            {
                $(this).attr("class","first");
            }
            if(liCounter == template_id)
            {
                if(liCounter == 1)
                {
                    $(this).attr("class","first active");
                }
                else
                {
                    $(this).attr("class","active");
                }
            }
            liCounter++;
        });
        if(project_id == "")
        {
            $("#buttonCreateText").hide();
            $("#buttonCreateHead").hide();
            $("#buttonCreateCloud").hide();
            $("#buttonPreviewTemplate").hide();
            $("#buttonPublishTemplate").hide();
            $("#makeyourowntemplate").show();
        }
        else
        {
            $("#buttonCreateText").show();
            $("#buttonCreateHead").show();
            if(template_id == 1)
            {
                $("#buttonCreateCloud").hide();
            }
            else
            {
                $("#buttonCreateCloud").show();
            }                    
            $("#buttonPreviewTemplate").show();
            $("#buttonPublishTemplate").show();
            $("#makeyourowntemplate").hide();
            textCreator = new TextCreator("textCreatorDiv");
            textCreator.load("sprite-26-0.png", "images/");
        }
                
        Common.setProjectId(project_id);
        Common.setTemplateId(template_id);
        Common.setPublishCode(publish_code);
        headshowcase.init("headshowcase");	
        //headshowcase.setWorkspace();
        var fileUploader = new FileUploader("fileUploaderDiv");
        $("#lnkLogin").click(function()
        {
            login = new Login("loginDiv");
            login.load();
        });
        $("#buttonCreateText").click(function()
        {
            textCreator = new TextCreator("textCreatorDiv");
            textCreator.load("sprite-26-0.png", "images/");                    
        });
        $("#buttonCreateHead").click(function()
        {
            Common.setUploadCategory("head");
            FileUploader.show();
        });
        $("#buttonCreateCloud").click(function()
        {
            Common.setUploadCategory("cloud");
            FileUploader.show();
        });
		
        var textCreator;
        $("#makeyourowntemplate").click(function()
        {
            document.getElementById('buttonPreprocessTemplate').value = "template";
                        
        //$("#buttonCreateHead").show();
        //$("#buttonPreviewTemplate").show();
        //$("#buttonPublishTemplate").show();
        //$("#makeyourowntemplate").hide();
        //textCreator = new TextCreator("textCreatorDiv");
        //textCreator.load("sprite-26-0.png", "images/");
        });	
        $("#buttonPublishTemplate").click(function()
        {
            if(Common.getPublishCode() == "")
            {
                alert("Please log in to publish");
                return false;
            }
            else
            {
                publishForm.setAttribute("target", "_blank");
            }
        });
        $("#buttonPreviewTemplate").click(function()
        {
            document.getElementById('buttonPreviewTemplateProjectId').value = Common.getProjectId();
            document.getElementById('buttonPreviewTemplateMessage').value = Common.getMessage();
            previewForm.setAttribute("target", "_blank");
        });
    }); 
});
