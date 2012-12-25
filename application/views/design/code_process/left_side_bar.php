<ol id="selectable">
    <?php 
    
    if(isset($selected_project))
    {
        echo $selected_project->project_content_backup;
    }
    else
    {
?>
    <li class="ui-widget-content" id="0">Click here to edit block</li>
    <?php 
    
    }?>
</ol>