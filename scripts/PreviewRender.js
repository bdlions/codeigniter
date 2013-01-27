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
                            window.location.reload();    
                            $(this).dialog('destroy');
                    }				
                },
                open: function() 
                {

                },
                close: function() {
                    window.location.reload();                
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