<table align="center" style="height:400px">
    <tr>
        <td colspan="4">
            <div id="divImageCanvas" style="border: 1px black solid; height: 401px; width: 723px; display: block; margin-left: auto; margin-right: auto;">
                <script type="text/javascript">                                                    
                                                    
                    template_id = '<?php echo $template_id ?>';
                    project_id = '<?php echo $project_id ?>';
                    publish_code = '<?php echo $publish_code ?>';
                    base = '<?php echo $base ?>'; 
                    from = '<?php echo $from ?>'; 
                    to = '<?php echo $to ?>'; 
                    message = '<?php echo $message ?>'; 
                                                    
                    var template1ImageCanvas = null;
                    var template1Image = null;
                    var template1ImageCanvasContext = null;
							
                    var selectedTemplateId = "";
							
                    window.onload = function()
                    {
                        template1ImageCanvas = document.getElementById("template1ImageCanvas");
                        template1Image = new Image();
								
                        if(template1ImageCanvas.getContext)
                        {
                            template1ImageCanvasContext = template1ImageCanvas.getContext('2d');									
                            template1ImageCanvas.width = 723 ;
                            template1ImageCanvas.height = 401 ;
									
                            template1Image.onload = function()
                            {
                                template1ImageCanvasContext.drawImage(template1Image, 0, 0, template1Image.width, template1Image.height);
										
                            };									
                            template1Image.src = '../images/template'+template_id+'.png';
                        }
                    }
                </script>
                <canvas id="template1ImageCanvas"> 
                    Sorry, your browser doesn't support HTML5.
                </canvas>
            </div> 
        </td>
    </tr>
    <tr align="center"  class="custombutton">
        <td style="float:left;">	    
            <input style="visibility:hidden" type = "button" name = "buttonCreateText" id="buttonCreateText" value="Step 1: Prepare your text" class="custombuttonlightgreen"/>
        </td>
        <td style="float:left;">	    
            <input style="visibility:hidden" type = "button" name = "buttonCreateHead" id="buttonCreateHead" value="Step 2: Create new head - upload file" class="custombuttonlightgreen"/>
        </td>
        <td style="float:left;">	    
            <input style="visibility:hidden" type = "button" name = "buttonCreateCloud" id="buttonCreateCloud" value="Step 3: Create new cloud - upload file" class="custombuttonlightgreen"/>
        </td>
        <td>
            <?php echo form_open("mytemplates/template" . $template_id); ?>
            <input type = "hidden" name = "buttonPreprocessTemplate" id="buttonPreprocessTemplate" value=""/>
            <input type = "submit" name = "makeyourowntemplate" id="makeyourowntemplate" value="Make Your Own!" class="custombuttonlightgreen"/>
            <?php echo form_close(); ?>
        </td>
    </tr>
    <tr>
        <td colspan="3">

        </td>
        <td  style="float:right;">	    
            <?php echo form_open_multipart("mytemplates/publishtemplate/" . $publish_code, array('id' => 'publishForm', 'name' => 'publishForm')); ?>
            <input style="visibility:hidden" type = "submit" name = "buttonPublishTemplate" id="buttonPublishTemplate" value="Publish" class="custombuttonlightred"/>
            <?php echo form_close(); ?>
        </td>
        <td  style="float:right;">	    
            <?php echo form_open_multipart("mytemplates/previewtemplate/" . $template_id, array('id' => 'previewForm', 'name' => 'previewForm')); ?>
            <input type = "hidden" name = "buttonPreviewTemplateProjectId" id="buttonPreviewTemplateProjectId" value=""/>
            <input type = "hidden" name = "buttonPreviewTemplateMessage" id="buttonPreviewTemplateMessage" value=""/>
            <input style="visibility:hidden" type = "submit" name = "buttonPreviewTemplate" id="buttonPreviewTemplate" value="Preview" class="custombuttonlightred"/>
            <?php echo form_close(); ?>
        </td>

    </tr>
    <!--<tr>
        <td colspan="4">
            <div id="balloonslist" class="headshowcase" style="border: 1px black solid; height: 70px;display: block; margin-left: auto; margin-right: auto;">
                <ul style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1;  left: -340px;">
                    <li style="overflow: hidden; float: left; width: 50px; height: 70px;"><img draggable="true" src="../../templates/<?php echo $template_id ?>/assets/graphics/1x/<?php echo $project_id ?>/sprite-3-0.png" alt="1"></li>
                    <li style="overflow: hidden; float: left; width: 50px; height: 70px;"><img draggable="true" src="../../templates/<?php echo $template_id ?>/assets/graphics/1x/<?php echo $project_id ?>/sprite-5-0.png" alt="2"></li>
                    <li style="overflow: hidden; float: left; width: 50px; height: 70px;"><img draggable="true" src="../../templates/<?php echo $template_id ?>/assets/graphics/1x/<?php echo $project_id ?>/sprite-16-0.png" alt="3"></li>
                </ul>
            </div>
        </td>

    </tr>-->
</table>
<div style="visibility: hidden; height:0px;">
    <div id="textCreatorDiv" style="border: 1px black solid; display: block;">				
        <table align="center">					
            <tr>
                <td colspan="2">
                    <canvas id="textCreatorCanvas"> 
                        Sorry, your browser doesn't support HTML5.
                    </canvas>
                </td>
            </tr>
            <tr>
                <td><label>From</label>&nbsp;</td>
                <td><label for="fromText"></label>
                    <input type="text" name="fromText" id="fromText" maxlength="20"></td>
            </tr>	
            <tr>
                <td><label>To</label>&nbsp;</td>
                <td><label for="toText"></label>
                    <input type="text" name="toText" id="toText" maxlength="20"></td>
            </tr>	
            <tr>
                <td><label>Message</label>&nbsp;</td>
                <td><label for="messageText"></label>
                    <input type="text" name="messageText" id="messageText" maxlength="20"></td>
            </tr>					
        </table>	
    </div> 
    <div id="fileUploaderDiv" title="Basic dialog">
        <?php echo form_open_multipart('mytemplates/upload', array('id' => 'fileUploadForm', 'name' => 'fileUploadForm')); ?>
        <table>
            <tr>
                <td colspan="3">
                    <label>Upload a photo of you or yourrself</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="fileName" id="fileName"/>
                </td>
                <td>
                    <div id='file_browse_wrapper'>
                        <input type='file' name="userfile" id='file_browse'/>
                    </div>
                </td>
            </tr>
        </table>
        <?php echo form_close(); ?>
        <div id="displayer"><label>loading...</label><img src="../images/loader.gif" width="80" height="40" alt="loader"/></div>
    </div>

    <div id="headCreatorDiv" style="border: 1px black solid; display: block;">
        <canvas id="headCreatorCanvas" style="width: 500px; height:250px;"> 
            Sorry, your browser doesn't support HTML5.
        </canvas>				
        <table style="margin-left:auto; margin-right: auto;">
            <tr>
                <td><input type="radio" id="redballoon" name="image" value="redballoon" checked/><label for="image1">Red</label></td>
                <td><input type="radio" id="yellowballoon" name="image" value="yellowballoon" /><label for="image2">Yellow</label></td>
                <td><input type="radio" id="greenballon" name="image" value="greenballon" /><label for="image3">Green</label></td>

                <td><input id="buttonClockwiseRotation" type="image" src="../images/clockwiserotate.jpg"/></td>
                <td><input id="buttonAntiClockwiseRotation" type="image" src="../images/anticlockwise.jpg"/></td>
                <td><input id="buttonZoomIn" type="image" src="../images/zoomin.jpg"/></td>
                <td><input id="buttonZoomOut" type="image" src="../images/zoomout.jpg"/></td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <canvas id="head1CroppedCanvas"> 
                        Sorry, your browser doesn't support HTML5.
                    </canvas>
                </td>
                <td>
                    <canvas id="head2CroppedCanvas"> 
                        Sorry, your browser doesn't support HTML5.
                    </canvas>
                </td>
                <td>
                    <canvas id="head3CroppedCanvas"> 
                        Sorry, your browser doesn't support HTML5.
                    </canvas>
                </td>
            </tr>
        </table>
    </div>
    <div id="cloudCreatorDiv" style="border: 1px black solid; display: block;">
        <canvas id="cloudCreatorCanvas" style="width: 500px; height:250px;"> 
            Sorry, your browser doesn't support HTML5.
        </canvas>
        <canvas id="cloudCroppedCanvas"> 
            Sorry, your browser doesn't support HTML5.
        </canvas>
    </div>
    <div id="joinTodayDiv">
        <div class="share_wrapper">
            <div class="share">
                <div id="left_promo" class="join_left">
                    <h1 class="red">Join Today!</h1>
                    <h2>To send this card</h2>
                    <div id="ecard_preview_container_294673637">
                        <img width="300" height="225" alt="template_thumb" src="http://aka.media.jibjab.com/assets/06/44/03/73/30h0qw.png">
                    </div>
                    <br>
                </div>
                <div class="divider"></div>
                <div class="join_right animated_container">
                    <div id="right_container" class="register">              
                        <div id="two_ways" class="right_pane modal_holiday signin">
                            <div class="signin_foot">
                                <div class="b_create">
                                    <a class="button create_account_link" href='<?php echo $base ?>auth/create_user'>Create an account on JibJab</a>
                                </div>
                                <p>
                                (already have a JibJab account?
                                <a class="log_in_link" rel="nofollow" title="Log In" href='<?php echo $base ?>auth/signin'>Log in</a>
                                )
                                </p>
                            </div>                         
                        </div>        
                        <div id="create_account" class="right_pane login" style="display: none;"></div>
                        <div id="sign_in" class="right_pane login" style="display: none;"></div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<canvas id="croppedImageCanvas" style="visibility: hidden;"> 
    Sorry, your browser doesn't support HTML5.
</canvas>