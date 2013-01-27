define(["jquery", "Common", "FileUploader"], function($, Common, FileUploader) 
{
	
    function PreviewRender(div)
    {
        var previewRenderDiv = $("#"+div );
        
        var dialogOpts = 
        {
                title: "Preview",
                modal: true,
                autoOpen: false,
                height: 570,
                width: 750,
                position: [0,0],
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
        previewRenderDiv.dialog(dialogOpts);

        PreviewRender.prototype.load = function()
        {
            previewRenderDiv.dialog(dialogOpts);
            previewRenderDiv.dialog("open");    
            
        };		
    };
    return PreviewRender;
});