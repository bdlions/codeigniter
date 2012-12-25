<div class='box'>

    <h1>Account Inactive</h1>
    <p>Please activate your account first</p>
    <?php echo form_open('auth/send_email_activation/'.$id); ?>       
        <?php echo form_submit('submit', 'Resend Activation email'); ?>    
    <?php echo form_close(); ?>
</div>

