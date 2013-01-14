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
			height: 320,
			width: 560,
			buttons: 
			{
				
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
                    
                    $("#button_login_submit").click(function(event)
                    {
			$('#loginForm').submit();			
                    });
		};		
	};
        
        $('#loginForm').submit(function() { 
            // submit the form 
            $(this).ajaxSubmit(
            {
                beforeSubmit: function() 
                {

                },
                success: function(resp) 
                {
                    var result = JSON.parse(resp);
                    alert("success: user name:"+result.userName+" and password:"+result.password);                    
                    
                }
            }); 
            return false; 
	});
        
	return Login;
});