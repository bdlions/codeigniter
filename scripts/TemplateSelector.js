define(["jquery", "Common", "FileUploader"], function($, Common, FileUploader) 
{
	
    function TemplateSelector(div)
    {
        var templateSelectorDiv = $("#"+div );

        var dialogOpts = 
        {
                title: "",
                modal: true,
                autoOpen: false,
                height: 540,
                width: 770,
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
        templateSelectorDiv.dialog(dialogOpts);

        TemplateSelector.prototype.load = function( )
        {
            templateSelectorDiv.dialog(dialogOpts);
            templateSelectorDiv.dialog("open");
        };		
    };
    return TemplateSelector;
});