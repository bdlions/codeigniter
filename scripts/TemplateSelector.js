define(["jquery", "Common", "FileUploader"], function($, Common, FileUploader) 
{
	
    function TemplateSelector(div)
    {
        var imageStartX, imageStartY;
        var templateSelectorDiv = $("#"+div );
        var templateSelectorCanvas = templateSelectorDiv.find("canvas")[0];
        var templateSelectorContext;
        var templateSelectorImage = new Image();

        var dialogOpts = 
        {
                title: "",
                modal: true,
                autoOpen: false,
                height: 530,
                width: 750,
                buttons: 
                {
                    'Cancel': function() 
                    {
                            $(this).dialog('destroy');
                    }				
                },
                open: function() 
                {

                }
        };
        templateSelectorDiv.dialog(dialogOpts);

        TemplateSelector.prototype.load = function( imageName, imagePath )
        {
            templateSelectorDiv.dialog(dialogOpts);
            templateSelectorDiv.dialog("open");    
            if(templateSelectorCanvas.getContext)
            {
                templateSelectorContext = templateSelectorCanvas.getContext("2d")				
                templateSelectorImage.onload = function()
                {
                    //set the image start position x and y pos
                    imageStartX = 0;
                    imageStartY = 0;
                    templateSelectorCanvas.width = templateSelectorImage.width;
                    templateSelectorCanvas.height = templateSelectorImage.height;
                    templateSelectorContext.drawImage(templateSelectorImage, imageStartX, imageStartY, templateSelectorImage.width, templateSelectorImage.height);
                };				
                //set the image
                templateSelectorImage.src = Common.getBaseUrl()+imagePath + imageName+"?"+new Date().getTime();	
            }
        };		
    };
    return TemplateSelector;
});