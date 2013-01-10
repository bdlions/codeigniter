define(["jquery", "Common"], function($, Common) 
{
	
	function Login(div)
	{
		var loginDiv = $("#"+div );
		var dialogOpts = 
		{
			title: "Login",
			modal: true,
			autoOpen: false,
			height: 410,
			width: 400,
			buttons: 
			{
				'Cancel': function() 
				{
					$(this).dialog('destroy');
				}
				,
				'Continue': function() 
				{
					$(this).dialog('destroy');					
                                        
				}
			},
			open: function() 
			{
				
			}
		};
		loginDiv.dialog(dialogOpts);		
		Login.prototype.load = function()
		{
			loginDiv.dialog(dialogOpts);
			loginDiv.dialog("open");
		};		
	};
	return Login;
});