<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        echo $css;
        echo $js;
        ?>
        <title></title>
    </head>

    <body class="channel_holidays holidays">
        <div id="hwrap">
            <div id="header">
                <div id="logo_wrap">
                    <a id="mylogo" title="JibJab" href="#">JibJab</a>
                </div>
                <div id="main_nav_wrap">
                    <div id="main_nav">
                        <?php
                            if(!empty($menu_bar))
                            {
                                $this->load->view($menu_bar);
                            }
                        ?>
                        <!--<ul>
                            <li class="first"><a href="<?php echo $base ?>templates/template1" class="holidays">Template 1</a></li>
                            <li class=""><a href="<?php echo $base ?>templates/template2" class="year_in_review">Template 2</a></li>
                            <li class=""><a href="<?php echo $base ?>templates/about" class="year_in_review">About</a></li>

                        </ul>-->
                    </div>
                </div>

                <div id="my_nav_wrap">
                    <div id="user-nav">
                        <ul>
                            <li><a href='<?php echo $base ?>auth/adduser'>Become a Member</a></li>
                            <?php if (empty($is_logged_in)) { ?>
                                <!--<li><a rel="nofollow" id="lnkLogin" href='#' name="lnkLogin">Login</a></li>-->
                                <li><a rel="nofollow" id="lnkLogin" href='<?php echo $base ?>auth/signin' name="lnkLogin">Login</a></li>
                            <?php } else { ?>
                                <li><a rel="nofollow" id="lnkLogin" href='<?php echo $base ?>auth/logout' name="lnkLogin">Logout</a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- menu end-->

        <div id="wwrap">
            <div id="wrap">
                <?php
                if (empty($main_content)) {
                    $this->load->view("templates/index");
                } else {
                    $this->load->view($main_content);
                }
                ?>

            </div><span class="not_semantic">&nbsp;</span>
        </div> 
        <div id="fwrap">
            <div id="footer">
                <div class="logo"></div>

                <div class="footer_links">
                    <ul>
                        <li><a title="About" href="<?php echo $base ?>mytemplates/about">About</a></li>
                        <li><a title="Copyright" href="<?php echo $base ?>mytemplates/copyright">Copyright</a></li>
                        <li><a title="Privacy" href="<?php echo $base ?>mytemplates/privacy">Privacy</a></li>
                    </ul>        
                </div>
            </div>
        </div>
        <div style="visibility: hidden; height:0px;">
            <div id="loginDiv">
                <div class="login_modal_content">
                    <div class="login_modal_header">
                        <img class="login_modal_header_logo" width="91" height="58" alt="JibJab" src="images/jibjab_logo.png"/>
                        <h2 class="login_h2">Sign in to your JibJab Account</h2>
                        <p class="login_p">
                            (Forgot your password?
                            <a class="login_a" href="<?php echo $base ?>auth/forgot_password">Click Here</a>
                            )
                        </p>                        
                    </div>
                    <?php echo form_open_multipart('auth/check_login', array('id' => 'loginForm', 'name' => 'loginForm')); ?>
                        <div class="warnings">
                            <span rel="global_errors"></span>
                        </div>
                        <div class="fl_error red" rel="email_error"> 
                        </div>
                        <div class="login_placeholdered_text">
                            <fieldset class="login_fieldset" rel="email">
                                <label class="login_label" for="modal_login_profile_email">Email Address</label>
                                <input class="login_input" id="modal_login_profile_email" name="modal_login_profile_email" type="text" name="login_name"/>
                            </fieldset>
                        </div> 
                        <div class="login_placeholdered_text">
                            <fieldset class="login_fieldset" rel="password">
                                <label class="login_label" for="modal_login_profile_email">Password</label>
                                <input class="login_input" id="modal_login_profile_password" name="modal_login_profile_password" type="password" name="login_password"/>
                            </fieldset>
                        </div>                        
                    </form>
                    <div class="login_b_signin">
                        <input id="button_login_submit" name="button_login_submit" class="login_submit" type="submit"/>
                    </div>
                </div>
                

            </div>
        </div>
    </body>
</html>