define(["jquery", "Common"], function($, Common) 
{

    function JoinToday(div)
    {
        var joinTodayDiv = $("#"+div );
        var dialogOpts = 
        {
            title: "",
            modal: true,
            autoOpen: false,
            height: 520,
            width: 980,
            buttons: 
            {

            },
            open: function() 
            {

            }
        };
        joinTodayDiv.dialog(dialogOpts);		
        JoinToday.prototype.load = function()
        {
            joinTodayDiv.dialog(dialogOpts);
            joinTodayDiv.dialog("open");
        };		
    };
    return JoinToday;
});