require(["jquery", "Jcarousellite", "TemplateSelector","Login"], function($, Jcarousellite, TemplateSelector, Login) {
    $(function() {		
        Jcarousellite.carouselify();
        function isBrowserCanvasCompatible()
        {
                var canvas = document.createElement("canvas");
                return !!canvas.getContext&&!!canvas.getContext("2d");
        };
        $("#lnkLogin").click(function()
        {
            //login = new Login("loginDiv");
            //login.load();
        });
        $("#template1_home").click(function()
        {
            document.getElementById('selectedTemplateId').value = 1;
            templateSelector = new TemplateSelector("displaySelectedTemplateDiv");
            templateSelector.load("template1.png", "images/"); 
        });
        $("#template2_home").click(function()
        {
            document.getElementById('selectedTemplateId').value = 2;
            templateSelector = new TemplateSelector("displaySelectedTemplateDiv");
            templateSelector.load("template2.png", "images/");
        });
        if(!isBrowserCanvasCompatible())
        {
            alert("Your browser doesn't support html5. Please update your browser.");
        }
    }); 
});
