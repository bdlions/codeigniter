<!DOCTYPE html >
<html>
	<head>
        <title>Ecards Processing</title>
		<meta charset="UTF-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"> 
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"> 
                <meta content="Ecards, image, processing" name="keywords">
		<meta content="mtea" name="author">
		<link href="<?php echo base_url()?>css/jquery-ui.css" rel="stylesheet"/>
		<link href="<?php echo base_url()?>css/filebrowser.css" rel="stylesheet"/>
		<script data-main="<?php echo base_url()?>scripts/maindisplay" src="<?php echo base_url()?>scripts/require-jquery.js"></script>
		<style type="text/css">
			.main {
				margin-left: 40px;
			}
			.headshowcase {
				margin: 0 0 20px 10px;
				padding: 10px 0 0;
				position: relative;
			}
		</style>
                <script type="text/javascript">
                    function isBrowserCanvasCompatible()
                    {
                            var canvas = document.createElement("canvas");
                            return !!canvas.getContext&&!!canvas.getContext("2d");
                    };
                    if(!isBrowserCanvasCompatible())
                    {
                        alert("Your browser doesn't support html5. Please update your browser.");
                        window.location.href = "../../mytemplates/redirect_path";
                    }
                    
                    function shareInFacebook()
                    {
                        var browser_url = document.location.href;
                        window.open('https://www.facebook.com/dialog/feed?%20%20%20app_id=161414874010559&%20%20%20link='+browser_url+'&%20%20%20picture=http://apurbogroup.net/mtea/images/jibjab_logo.png&%20%20%20name='+browser_url+'&%20%20%20caption=Ecard&%20%20%20description=Custom%20ecards.&%20%20%20redirect_uri=http://apurbogroup.net/mtea','','width=600,height=400');
                    }
                </script>
	</head>	

	<body style="padding:0px; margin:10px;">
		<script type="text/javascript"> 
                    template_id = '<?php echo $template_id ?>';
                    project_id = '<?php echo $project_id ?>';
                </script>
	 
		<table style="width:730px; height:450px;">
                    <tr style="height:50px;">
                        <td>
                            <h3 style="color:#336699; font-family:Arial; border-bottom:1px solid #555555;">Your eCard <?php echo $template_message ?></h3>            
                        </td>
                    </tr>
                    <tr style="height:400px;">
                        <td>
                            <div id="haxe:jeash" style="border:1px solid #555555; background-color: #000000; width: 720px; height: 400px; top:55px;" data-framerate="65"></div>
                        </td>
                    </tr>                   
                </table>
                
		
		<!-- <div id="haxe:trace" style="position: absolute; z-index: 2147483647; display: none;"></div> -->
		
		
		
                
		
	</body>
</html>