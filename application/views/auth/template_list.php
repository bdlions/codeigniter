<div class='mainInfo'>

    <h1>Users</h1>
    <div id="infoMessage"><?php echo $message; ?></div>
    <table style="width:100%">
        <caption>Below is a list templates</caption>
        <thead>
            <tr>
                <th>Template</th>
                <th>Edit ecard</th>
                <th>Show ecard</th>
                <th>Delete the ecard</th>
                <th>Creation date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($template_list as $template): ?>
                <tr>
                    <td><?php echo $template->template_name; ?></td>
                    <td><?php echo anchor("mytemplates/open_selected_template/".$template->project_id, 'Edit'); ?></td>
                    <td><?php echo anchor("auth/showecard/".$template->publish_code, 'Show',array('target'=>'_blank')); ?></td>
                    <td><?php echo anchor("mytemplates/delete_template/".$template->project_id, 'Delete'); ?></td>
                    <td><?php echo $template->created_date; ?></td>
                </tr>
            <?php endforeach; ?>                
        </tbody>                    
    </table>
</div>
