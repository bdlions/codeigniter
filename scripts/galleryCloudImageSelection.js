define(["jquery", "Common", "imageSelector", "HeadCreator", "CloudCreator"], function($, Common, imageSelector, HeadCreator, CloudCreator) 
    {
	
        function GalleryCloudImageSelection(div)
        {
            var a = $(".carousel").imageSelector({
				btnNext: ".next",
				btnPrev: ".prev"
			});
            var galleryCloudImageSelection = $("#"+div );
            
            var headCreator;
            var cloudCreator;
            
            var dialogOpts = 
            {
                title: "Select an image",
                modal: true,
                autoOpen: false,
                height: 250,
                width: 520,
                buttons: 
                {
                    'Upload a file': function() 
                    {   
                        $(this).dialog('destroy');                                        
                    },
                    'Use selected image': function() 
                    {
                        if(Common.getUploadCategory() == "head")
                        {
                            headCreator = new HeadCreator("headCreatorDiv");
                            headCreator.load(Common.getGallerySelectedName(), "images/gallery/"+Common.getTemplateId()+"/balloons/");
                        }
                        else if(Common.getUploadCategory() == "cloud")
                        {
                            cloudCreator = new CloudCreator("cloudCreatorDiv");
                            cloudCreator.load(Common.getGallerySelectedName(), "images/gallery/"+Common.getTemplateId()+"/clouds/");
                        }
                        $(this).dialog('destroy');
                    },
                    'Cancel': function() 
                    {
                        $(this).dialog('destroy');
                    }
                },
                open: function() 
                {
				
                }
            };
            galleryCloudImageSelection.dialog(dialogOpts);		
            GalleryCloudImageSelection.prototype.load = function()
            {
                galleryCloudImageSelection.dialog(dialogOpts);
                galleryCloudImageSelection.dialog("open");
                    
                    
            };		
        };
        return GalleryCloudImageSelection;
    });