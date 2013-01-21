<script type="text/javascript">
    base = '<?php echo $base ?>';
</script>
<div class="slider">
    <a title="previous" href="#" id="prevBtn" class="prev">Previous</a>
    <a title="next" href="#" id="nextBtn" class="next">Next</a>	
    <div class="carousel">
        <ul>
            <li><img id="template1_home" name="template1_home" alt="" src="<?php echo $base?>images/template1.png"></li>
            <li><img id="template2_home" name="template2_home" alt="" src="<?php echo $base?>images/template2.png"></li>
        </ul>
    </div>
</div>
<div style="visibility: hidden; height:0px;">
    <div id="displaySelectedTemplateDiv">				
        <table>					
            <tr>
                <td>
                    <canvas id="selectedTemplateImageCanvas"> 
                        Sorry, your browser doesn't support HTML5.
                    </canvas>
                </td>
            </tr>   
            <tr align="center"  class="custombutton">
                <td class="custombutton">
                    <?php echo form_open("mytemplates/load_template"); ?>
                    <input type = "hidden" name = "selectedTemplateId" id="selectedTemplateId" value=""/>
                    <input type = "submit" name = "makeyourowntemplate" id="makeyourowntemplate" value="Make Your Own!" class="custombuttonlightgreen"/>
                    <?php echo form_close(); ?>
                </td>
            </tr>            
        </table>	
    </div>
</div>