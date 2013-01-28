<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php 
    echo $css;
    echo $js;
  ?>
   <link type="text/css" rel="stylesheet" media="screen" href="<?php echo base_url();?>css/main--.css" />
  <link type="text/css" rel="stylesheet" media="screen" href="<?php echo $base?>css/birthdays.css" />  
  <link href="<?php echo base_url()?>css/filebrowser.css" rel="stylesheet"/>
  <script data-main="<?php echo base_url()?>scripts/main" src="<?php echo base_url()?>scripts/require-jquery.js"></script>
  <title></title>
</head>

<body class="channel_birthdays sendables__casting category_birthdays ecards layout common pages">
  <div id="hwrap">
    <div id="header">
        <div id="logo_wrap">
            <a id="mylogo" title="JibJab" href="#">JibJab</a>
        </div>
        <div id="main_nav_wrap">
        <div id="main_nav">
          <ul>
            <?php
                if(!empty($menu_bar))
                {
                    $this->load->view($menu_bar);
                }
            ?>
          </ul>
        </div>
      </div>

      <div id="my_nav_wrap">
        <div id="user-nav">
          <ul>
            <?php if (empty($is_logged_in)) { ?>
                <li><a href='<?php echo $base ?>auth/adduser'>Become a Member</a></li>
                <li><a rel="nofollow" id="lnkLogin" href='<?php echo $base ?>auth/signin' name="lnkLogin">Login</a></li>
            <?php } 
                else 
                { 
                if (empty($is_admin)) { ?>
                    <li><a href='<?php echo $base ?>auth/logout'>Logout</a></li>                                    
                    <li><a href='<?php echo $base ?>auth/show_user'>Show profile</a></li>
                    <li><a href='<?php echo $base ?>auth/edit_user'>Edit profile</a></li>
                    <li><a href='<?php echo $base ?>mytemplates/templates'>My cards</a></li>
                    <li><a href="#">
                            <?php if (empty($user_name)) { ?>
                                Guest
                            <?php                                            
                            } 
                            else
                            { 
                                echo $user_name;
                            } ?>
                        </a></li>
                <?php } else { ?>
                    <li><a rel="nofollow" id="lnkLogin" href='<?php echo $base ?>admin/logout' name="lnkLogin">Logout</a></li>
                <?php } ?>
            <?php } ?>
            
          </ul>
        </div>
      </div>
    </div>
  </div><!-- menu end-->
  
  <div id="wwrap">
    <div id="wrap">
        <div class="casting" id="postcard_layout">
            <div class="header">
                <ul class="steps">
                    <li class="first active"></li>
                </ul>
            </div>
                <?php
                    if(empty($main_content))
                    {
                        $this->load->view("templates/template");
                    }
                    else
                    {
                        $this->load->view($main_content);
                    }
                ?>
            <div class="casting_player"></div>
        </div>
    </div><span class="not_semantic">&nbsp;</span>
  </div> 
  <div id="fwrap">
    <div id="footer">
      <div class="logo"></div>
      
      <div class="footer_links">
        <ul>
          <li><a title="About" href="<?php echo $base?>mytemplates/about">About</a></li>
          <li><a title="Copyright" href="<?php echo $base?>mytemplates/copyright">Copyright</a></li>
          <li><a title="Privacy" href="<?php echo $base?>mytemplates/privacy">Privacy</a></li>
        </ul>        
      </div>
    </div>
  </div>
</body>
</html>