require(["jquery", "Jcarousellite", "TemplateSelector", "Common", "HomeBalloonsTT1"], function($, Jcarousellite, TemplateSelector, Common, HomeBalloonsTT1) {
    $(function() {		
        Jcarousellite.carouselify();
        function isBrowserCanvasCompatible()
        {
                var canvas = document.createElement("canvas");
                return !!canvas.getContext&&!!canvas.getContext("2d");
        };
        Common.setBaseUrl(base);
        $("#lnkLogin").click(function()
        {
            //login = new Login("loginDiv");
            //login.load();
        });
        $("#template1_home").click(function()
        {
            document.getElementById('selectedTemplateId').value = 1;
            templateSelector = new TemplateSelector("displaySelectedTemplateDiv");
            templateSelector.load();
            Common.setTemplateId(1);
            Common.setProjectId("");
            HomeBalloonsTT1.init();
        });
        $("#menu_bar_home_template1").click(function()
        {
            document.getElementById('selectedTemplateId').value = 1;
            templateSelector = new TemplateSelector("displaySelectedTemplateDiv");
            templateSelector.load(); 
            Common.setTemplateId(1);
            Common.setProjectId("");
            HomeBalloonsTT1.init();
        });
        $("#template2_home").click(function()
        {
            document.getElementById('selectedTemplateId').value = 2;
            templateSelector = new TemplateSelector("displaySelectedTemplateDiv");
            templateSelector.load();
            Common.setTemplateId(2);
            Common.setProjectId("");
            HomeBalloonsTT1.init();
        });
        $("#menu_bar_home_template2").click(function()
        {
            document.getElementById('selectedTemplateId').value = 2;
            templateSelector = new TemplateSelector("displaySelectedTemplateDiv");
            templateSelector.load();
            Common.setTemplateId(2);
            Common.setProjectId("");
            HomeBalloonsTT1.init();
        });
        if(!isBrowserCanvasCompatible())
        {
            alert("Your browser doesn't support html5. Please update your browser.");
        }
    }); 
});
