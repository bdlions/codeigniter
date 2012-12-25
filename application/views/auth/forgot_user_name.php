<div>
    <h1>Forgot User Name</h1>
    <p>Please enter your email address so we can send you an email to get your user name.</p>

    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("auth/forgot_user_name");?>

          <label>Email Address:</label>
          <?php echo form_input($email);?><br/>
         

          <label></label>
          <?php echo form_submit('submit', 'Submit');?>

    <?php echo form_close();?>
</div>