<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php echo $css?>"
  <title></title>
</head>

<body class="channel_holidays holidays">
  <div id="hwrap">
    <div id="header">
      <div id="main_nav_wrap">
        <div id="main_nav">
          <ul>
            <li class="first"><a href="<?php echo $base?>index.php/templates/template1" class="holidays">Template 1</a></li>
            <li class=""><a href="<?php echo $base?>index.php/templates/template2" class="year_in_review">Template 2</a></li>
            <li class=""><a href="<?php echo $base?>index.php/templates/about" class="year_in_review">About</a></li>
            
          </ul>
        </div>
      </div>

      <div id="my_nav_wrap">
        <div id="user-nav">
          <ul>
               <li><a href='<?php echo $base?>index.php/auth/create_user'>Become a Member</a></li>
            <?php if(empty($is_logged_in)){ ?>
               <li><a rel="nofollow" id="lnkLogin" href='<?php echo $base?>' name="lnkLogin">Login</a></li>
            <?php } else {?>
                <li><a rel="nofollow" id="lnkLogin" href='<?php echo $base?>index.php/auth/logout' name="lnkLogin">Logout</a></li>
            <?php }?>
            
          </ul>
        </div>
      </div>
    </div>
  </div><!-- menu end-->
  
  <div id="wwrap">
    <div id="wrap">
	  <div id="jibjab-member-text">
        <p class="non-member-header"></p>
      </div>
                  <?php
                if(empty($main_content))
                {
                    $this->load->view("templates/index");
                }
                else
                {
                    $this->load->view($main_content);
                }
            ?>
     
    </div><span class="not_semantic">&nbsp;</span>
  </div> 
  <div id="fwrap">
    <div id="footer">
      <div class="logo"></div>

      <div class="footer_links">
        <h4>Site Links</h4>

        <ul>
          <li><a title="About" href="<?php echo $base?>index.php/templates/about">About</a></li>
          <li><a title="Copyright" href="<?php echo $base?>index.php/templates/copyright">Copyright</a></li>
          <li><a title="Privacy" href="<?php echo $base?>index.php/templates/privacy">Privacy</a></li>
        </ul>        
      </div><span class="not_semantic">&nbsp;</span>
    </div>
  </div>
</body>
</html>