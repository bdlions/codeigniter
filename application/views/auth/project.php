<div class='mainInfo'>

    <h1>Create a project to generate template</h1>
    <div id="infoMessage"><?php if(isset($message)) echo $message; ?></div>
    <table>
        <caption>Below is a list of projects</caption>
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Open</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo $project->project_name; ?></td>
                    <td><?php echo anchor("welcome/load_project/" . $project->project_id, 'Open'); ?></td>
                    <td><?php echo anchor("auth/delete_project/" . $project->project_id, 'Delete'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
