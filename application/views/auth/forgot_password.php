<div>
    <h1>Forgot Password</h1>
    <p>Please enter your email address so we can send you an email to reset your password.</p>

    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("auth/forgot_password");?>

          <label>Email Address:</label>
          <?php echo form_input($email);?><br/>
         

          <label></label>
          <?php echo form_submit('submit', 'Submit');?>

    <?php echo form_close();?>
</div>