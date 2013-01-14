<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>
            
        </title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/template_style.css" />
        <?php

            //adding extra css if needs to load
            //a specific view
            if(!empty($css))
            {
                echo $css;
            }

            //lood some extra js if needed
            if(!empty($js))
            {
                echo $js;
            }

        ?>
    </head>
    <body>
	    <div class="BackgroundGradient"> </div>
        <div class="BodyContent">
            <div class="BorderBorder">
                <div class="BorderBL"><div></div></div>
                <div class="BorderBR"><div></div></div>
                <div class="BorderTL"></div>
                <div class="BorderTR"><div></div></div>
                <div class="BorderT"></div>
                <div class="BorderR"><div></div></div>
                <div class="BorderB"><div></div></div>
                <div class="BorderL"></div>
                <div class="BorderC"></div>
                <div class="Border">
                    <div class="Header">
                        <div class="HeaderTitle">
                            
                            
                        </div>
                    </div>
                    <div class="Menu">
                        <?php
                            if(!empty($menu_bar))
                            {
                                $this->load->view($menu_bar);
                            }
                            ?>
                    </div>
                    <div style="clear: both"/>
                    <div class="Columns">
                        <!-- Start of column1 -->
                        <div class="Column1">
                            <?php
                                if(!empty($left_side_bar))
                                {
                                    $this->load->view($left_side_bar);
                                }
                              ?>
                        </div>
                        <!--end of column1-->

                        <!-- Start of main div-->
                        <div class="MainColumn">
                            <?php
                                if(empty($main_content))
                                {
                                    $this->load->view("design/main_content");
                                }
                                else
                                {
                                    $this->load->view($main_content);
                                }
                              ?>
			</div>
                        <!-- End of main div -->
                    </div>
                    <div class="Footer">
                        
                    </div>
                    <span class="BackLink"></span>
                </div>
            </div>
        </div>
	</body>
</html>