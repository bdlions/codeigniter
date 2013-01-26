<div style="height: 468px">

    <p>Account Inactive. Did you activate your account? We sent you an email with an activation link. Please 
        check your email. Thank you.</p>
    <?php echo form_open('auth/send_email_activation/'.$id); ?>       
        <?php echo form_submit('submit', 'Resend Activation email'); ?>    
    <?php echo form_close(); ?>
</div>

