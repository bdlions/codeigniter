<ul id="nav">
    <li>
        <a href="#">Users</a>
        <ul>
            <?php
            echo anchor('auth/load_search', 'Search');
            echo anchor('auth', 'Show');
            ?>
        </ul>
    </li>
    <li><?php echo anchor('auth/logout', 'Logout'); ?></li>
</ul>
