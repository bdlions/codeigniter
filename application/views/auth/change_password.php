<div class="box">
    <h1>Change Password</h1>
    <div id="infoMessage"><?php echo $message;?></div>
    <?php echo form_open("auth/change_password");?>
        <fieldset>
            <legend>Change Password</legend>
              <label>Old Password:</label>
              <?php echo form_input($old_password);?><br/>
              

              <label>New Password:</label>
              <?php echo form_input($new_password);?><br/>
              

              <label>Confirm New Password:</label>
              <?php echo form_input($new_password_confirm);?><br/>
              

              <?php echo form_input($user_id);?>
              <label></label>
              <?php echo form_submit('submit', 'Change');?><br/>
          </fieldset>
    <?php echo form_close();?>
</div>