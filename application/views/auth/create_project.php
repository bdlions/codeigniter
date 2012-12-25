<div class='box'>

    <h1>Create Project</h1>
    <p>Please enter the project information below.</p>

    <div id="infoMessage" style="color:red"><?php echo $message;?></div>

    <?php echo form_open("project/create_project");?>
        <fieldset>
            <legend>Project creation information</legend>
            <table>
                <tr>
                    <td>
                        <label>Project Name: </label>
                    </td>
                        
                    <td>
                        <?php echo form_input($project_name);?><br/>   
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Select Teemplate:</label>
                    </td>
                        
                    <td align="right">
                        <?php echo form_dropdown('templates', $templates); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo form_submit('submit', 'Create Project');?>
                    </td>
                </tr>
            
            </table>
        </fieldset>
    <?php echo form_close();?>

</div>
