<div class='box'>
    <h1>Search User</h1>
    <p>Please select User Name / Last Name / Email and then type your text to search users</p>
    <div id="infoMessage"><?php echo $message; ?></div>
    <?php echo form_open("auth/load_search"); ?>
        <fieldset>
            <legend>User search information</legend>
            <table border="0" width="100%" >
                <tr align="left" style="color:green">
                    <td>
                        <label>User Name: </label>
                        <?php echo form_checkbox('username', 'accept', $username);?>  
                        <label>Last Name: </label>
                        <?php echo form_checkbox('lastname', 'accept', $lastname);?>
                        <label>Email: </label>
                        <?php echo form_checkbox('useremail', 'accept', $useremail);?>
                        <?php echo form_input($user_name); ?>                                     
                    </td>
                </tr>                       
            </table>
            <?php echo form_submit('submit', 'Search User'); ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>
