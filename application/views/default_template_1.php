<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>
            <?php
                if(empty($title))
                {
                    echo "Language processing";
                }
                else
                {
                    echo $title;
                }
            ?>
        </title>
            <STYLE type="text/css" media="screen">
      
			  * {
		  margin: 0;
		  padding: 0;
		}
	  #header {
            position: relative;
			width: 100%;
			z-index: 99;
      }

      #main {
        width: 100%;
		background-color:#2B7AB0;
      }

      #footer 
	  {
        width: 100%;
		height: 305px;
      }
	#round-corner
	{
		border-radius: 20px 20px 20px 20px;
		box-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
		height: 500px;
		margin: 0 auto 15px;
		padding: 20px 20px 33px;
		width: 916px;
		div-style:block;
		background-color:white;
	}
	#wrap
	{
		margin: 0 auto;
		padding-top: 20px;
	}
	#help_video_wrap 
	{
		color: #FFFFFF;
		font-size: 10px;
		height: 32px;
		margin: 0 auto 20px;
		padding: 16px 17px;
		width: 238px;
	}
    </STYLE>
    </head>
    <body>
        
         <DIV id="header"> <?php
                                if(empty($header))
                                { 
                                    echo "CREATE YOUR OWN ECARDS";
                                }
                                else
                                {
                                    echo $header;
                                }
                                ?>
         </DIV>
	        <DIV id="main">
		<DIV id="wrap">
			<DIV id="round-corner">
				<?php
                                print_r('main content:'.$main_content);
                                if(empty($main_content))
                                {
                                    $this->load->view("design/main_content");
                                }
                                else
                                {
                                    $this->load->view($main_content);
                                }
                              ?>
			</DIV>
		</div>
		<section>
			<div id="help_video_wrap">
			  <span>
				
			  </span>
			</div>
		</section>
	</DIV>
                   <DIV id="footer"> footer  </DIV>    

	</body>
</html>