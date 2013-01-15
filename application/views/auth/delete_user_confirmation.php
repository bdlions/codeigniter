<div style="height: 468px">
    <p>Are you sure you want to delete this user?</p>
    <?php echo form_open("admin/delete_user/".$user_id);?>
        <input type="submit" id="delete_user_yes" name="delete_user_yes" value="Yes"/>
        <input type="submit" id="delete_user_no" name="delete_user_no" value="No"/>
    <?php echo form_close();?>
</div>