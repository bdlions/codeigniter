<div class='box'>

    <h1>Create User</h1>
    <p>Please enter the users information below.</p>

    <div id="infoMessage"><?php echo $message; ?></div>

    <?php echo form_open("auth/create_user"); ?>

    <fieldset>
        <legend>User creation information</legend>
        <table border="0" width="100%" >
            <tr>
                <td width="16%"><label>User Name:</label></td>
                <td width="84%"> <?php echo form_input($user_name); ?></td>
            </tr>
            <tr>
                <td><label>First Name:</label></td>
                <td><?php echo form_input($first_name); ?></td>
            </tr>
            <tr>
                <td><label>Last Name: </label></td>
                <td><?php echo form_input($last_name); ?></td>
            </tr>
            <tr>
                <td><label>Email:</label></td>
                <td><?php echo form_input($email); ?></td>
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
                <td><label>Country:</label></td>
                <td><?php echo form_dropdown('countries', $countries); ?></td>
            </tr>
        </table>
        <?php echo form_submit('submit', 'Create User'); ?>
    </fieldset>



    <?php echo form_close(); ?>

</div>
