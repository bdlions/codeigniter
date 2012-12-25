<ul id="nav">
    <li>
        <a href="#">Project</a>
        <ul>
            <?php
                echo anchor('project/create_project', 'Create Project');
            ?>
        </ul>
    </li>
    <li><?php echo anchor('auth/logout', 'Logout'); ?></li>
</ul>
