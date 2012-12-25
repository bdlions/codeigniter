<div class='box'>

    <h1>User Information</h1>
    <div id="infoMessage"><?php echo $message; ?></div>
    <?php echo form_open('auth'); ?>
    <fieldset>
        <legend>User update information</legend>
        <table border="0" width="100%" >
            <tr>
                <td><label>User Name:</label></td>
                <td><?php echo form_input($user_name); ?></td>
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
                <td><label>Email: </label></td>
                <td><?php echo form_input($email); ?></td>
            </tr>
            <tr>
                <td><label>Registration Date: </label></td>
                <td><?php echo form_input($created_date); ?></td>
            </tr>
            <tr>
                <td><label>IP Address: </label></td>
                <td><?php echo form_input($ip_address); ?></td>
            </tr>
            <tr>
                <td><label>Browser: </label></td>
                <td><?php echo form_input($browser); ?></td>
            </tr>
            <tr>
                <td><label>Country:</label></td>
                <td><?php echo form_dropdown('countries', $countries, $selected_country); ?></td>
            </tr>
        </table>
        <?php echo form_submit('submit', 'Ok'); ?>
    </fieldset>
    <?php echo form_close(); ?>

</div>

