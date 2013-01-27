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
require(["jquery", "Common", "TextCreator", "headshowcase", "FileUploader","Login","JoinToday","PreviewRender","PreviewBalloonsTT1"], function($, Common, TextCreator, headshowcase, FileUploader, Login, JoinToday, PreviewRender, PreviewBalloonsTT1) {
    
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
        
        Common.setProjectId(project_id);
        Common.setTemplateId(template_id);
        Common.setPublishCode(publish_code);
        Common.setBaseUrl(base);
        Common.setFrom(from);
        Common.setTo(to);
        Common.setMessage(message);
        
        //PreviewBalloonsTT1.init();
        
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
            $("#buttonCreateText").attr("style", "visibility: visible");
            //$("#buttonCreateText").show();
            $("#buttonCreateHead").attr("style", "visibility: visible");
            //$("#buttonCreateHead").show();
            if(template_id == 1)
            {
                $("#buttonCreateCloud").attr("style", "visibility: hidden");
                //$("#buttonCreateCloud").hide();
            }
            else
            {
                $("#buttonCreateCloud").attr("style", "visibility: visible");
                //$("#buttonCreateCloud").show();
            }                    
            $("#buttonPreviewTemplate").attr("style", "visibility: visible");
            //$("#buttonPreviewTemplate").show();
            $("#buttonPublishTemplate").attr("style", "visibility: visible");
            //$("#buttonPublishTemplate").show();
            $("#makeyourowntemplate").attr("style", "visibility: hidden");
            //$("#makeyourowntemplate").hide();
            textCreator = new TextCreator("textCreatorDiv");
            textCreator.load();
        }
                
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
            textCreator.load();                    
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
                joinToday = new JoinToday("joinTodayDiv");
                joinToday.load();
                //alert("Please log in to publish");
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
        $("#testPreview").click(function()
        {   
            previewRender = new PreviewRender("previewRenderDiv");
            previewRender.load();  
            PreviewBalloonsTT1.init();
        });        
    }); 
});
