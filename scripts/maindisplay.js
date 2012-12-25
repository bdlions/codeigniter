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
require(["jquery", "Common", "TextCreator", "headshowcase", "FileUploader", "BalloonsTT1"], function($, Common, TextCreator, headshowcase, FileUploader, BalloonsTT1) {
    
	$(function() {
		Common.setProjectId(project_id);
                Common.setTemplateId(template_id);
                headshowcase.init("headshowcase");	
		//headshowcase.setWorkspace();
		BalloonsTT1.init();
		var fileUploader = new FileUploader("fileUploaderDiv");
		$("#buttonCreateHead").click(function()
		{
			//Common.setTemplateId("template1");
			fileUploader.show();
		});
		
		var textCreator;
		$("#makeyourowntemplate1").click(function()
		{
			//Common.setTemplateId("template1");
			textCreator = new TextCreator("textCreatorDiv");
			textCreator.load("sprite-26-0.png", "images/");
		});
		$("#template2").click(function()
		{
			//Common.setTemplateId("template2");
			textCreator = new TextCreator("textCreatorDiv");
			textCreator.load("sprite-26-0.png", "images/");
		});		
    });
});
