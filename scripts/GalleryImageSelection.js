define(["jquery", "Common", "imageSelector", "HeadCreator"], function($, Common, imageSelector, HeadCreator) 
    {
	
        function GalleryImageSelection(div)
        {
            var a = $(".carousel").imageSelector({
				btnNext: ".next",
				btnPrev: ".prev"
			});
            var galleryImageSelectionDiv = $("#"+div );
            
            var headCreator;
            
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
                        if(Common.getGallerySelectedName() == "")
                        {
                            alert("Please select an image fist.");
                            return;
                        }
                        if(Common.getTemplateId() == 1)
                        {
                            if(Common.getUploadCategory() == "head")
                            {
                                headCreator = new HeadCreator("headCreatorDiv");
                                headCreator.load(Common.getGallerySelectedName(), "images/gallery/"+Common.getTemplateId()+"/balloons/");
                            }                            
                        }
                        else if(Common.getTemplateId() == 2)
                        {
                            if(Common.getUploadCategory() == "head")
                            {
                                headCreator = new HeadCreator("headCreatorDiv");
                                headCreator.load(Common.getGallerySelectedName(), "images/gallery/"+Common.getTemplateId()+"/balloons/");
                            }
                            else if(Common.getUploadCategory() == "cloud")
                            {
                                headCreator = new HeadCreator("headCreatorDiv");
                                headCreator.load(Common.getGallerySelectedName(), "images/gallery/"+Common.getTemplateId()+"/clouds/");
                            }
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
            galleryImageSelectionDiv.dialog(dialogOpts);		
            GalleryImageSelection.prototype.load = function()
            {
                galleryImageSelectionDiv.dialog(dialogOpts);
                galleryImageSelectionDiv.dialog("open");
                    
                    
            };		
        };
        return GalleryImageSelection;
    });