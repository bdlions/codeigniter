<div class='mainInfo'>

    <h1>Users</h1>
    <div id="infoMessage"><?php echo $message; ?></div>
    <table style="width:100%">
        <caption>Below is a list templates</caption>
        <thead>
            <tr>
                <th>Template</th>
                <th>Link to ecard</th>
                <th>Creation date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($template_list as $template): ?>
                <tr>
                    <td><?php echo $template->template_name; ?></td>
                    <td><?php echo anchor("mytemplates/template" . $template->template_id, 'Open'); ?></td>
                    <td><?php echo $template->created_date; ?></td>
                </tr>
            <?php endforeach; ?>                
        </tbody>                    
    </table>
</div>
