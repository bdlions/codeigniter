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
require(["jquery", "Common", "TextCreator", "headshowcase", "FileUploader"], function($, Common, TextCreator, headshowcase, FileUploader) {
    
	$(function() {		
                if(project_id == "")
                {
                    $("#buttonCreateHead").hide();
                    $("#buttonCreateCloud").hide();
                    $("#buttonPreviewTemplate").hide();
                    $("#buttonPublishTemplate").hide();
                    $("#makeyourowntemplate").show();
                }
                else
                {
                    $("#buttonCreateHead").show();
                    $("#buttonCreateCloud").show();
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
