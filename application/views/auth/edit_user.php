<div class='box'>

    <h1>Update User</h1>
    <p>Please enter the user information below to update</p>
    <div id="infoMessage"><?php echo $message; ?></div>
    <?php echo form_open('auth/edit_user/'.$user_id); ?>

    <fieldset>
        <legend>User update information</legend>
        <table border="0" width="100%" >
            <tr>
                <td><label>First Name:</label></td>
                <td><?php echo form_input($first_name); ?></td>
            </tr>
            <tr>
                <td><label>Last Name: </label></td>
                <td><?php echo form_input($last_name); ?></td>
            </tr>
            <tr>
                <td><label>Password:</label></td>
                <td><?php echo form_input($password); ?></td>
            </tr>
            <tr>
                <td><label>Confirm Password: </label></td>
                <td><?php echo form_input($password_confirm); ?></td>
            </tr>
            <tr>
                <td><label>Group:</label></td>
                <td><?php echo form_dropdown('groups', $groups, $selected_group); ?></td>
            </tr>
            <tr>
                <td><label>Country:</label></td>
                <td><?php echo form_dropdown('countries', $countries, $selected_country); ?></td>
            </tr>
        </table>
        <?php echo form_submit('submit', 'Update User'); ?>
    </fieldset>
    <?php echo form_close(); ?>

</div>
