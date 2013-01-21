<style type="text/css">
    #outer
    {
        height:100%;
        width:100%;
        display:table;
        vertical-align:middle;
    }
    #container
    {
        text-align:center;
        position:relative;
        vertical-align:middle;
        display:table-cell;
        height:468px;
        width:300px;
    }

    #inner
    {
        background: none repeat scroll 0 0 lightgray;
        border: 0px solid #000000;
        height: 100px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        width: 500px;
        padding-top: 20px;
    }

    div .tabular
    {
        display: table; 
        border:#505050 solid 0px;
        padding: 5px;
        width:100%;
    }
    div .tabular-row
    {
        display: table-row;
        width:100%;
    }
    div .tabular-cell
    {
        display: table-cell; 
        border:#737373 solid 0px;
        padding: 5px;
        vertical-align: top;
        text-align: left;
    }
    label
    {
        float:right;
    }
    .p
    {
        font-size: 12px;
    }

</style>
<div id="outer">          
    <div id="container">         
        <div id="inner">
            <div style="color:red"><?php echo $message; ?></div>        
            <p>Forgot Password?</p> 
            <?php echo form_open("auth/forgot_password"); ?>
            <div class ="tabular">                
                <div class="tabular-row">
                    <div class="tabular-cell"><label for="identity">Email Address:</label></div>
                    <div class="tabular-cell"><?php echo form_input($email);?></div>
                </div>                
                <div class="tabular-row">
                    <div class="tabular-cell"></div>
                    <div class="tabular-cell"><?php echo form_submit('submit', 'Submit'); ?></div>
                </div>                              
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>