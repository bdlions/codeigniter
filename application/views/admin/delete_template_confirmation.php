<div style="height: 468px">
    <p>Are you sure you want to delete this ecard?</p>
    <?php echo form_open("admin/delete_template/".$project_id);?>
        <input type="submit" id="delete_template_yes" name="delete_template_yes" value="Yes"/>
        <input type="submit" id="delete_template_no" name="delete_template_no" value="No"/>
    <?php echo form_close();?>
</div>