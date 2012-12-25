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
        height: 210px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        width: 380px;
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

</style>

<div id="outer">
    <div id="container">
        <div style="color:red"><?php echo $message; ?></div>
        <div id="inner">
            <?php echo form_open("auth/login"); ?>
            <div class ="tabular">
                <div class="tabular-row">
                    <div class="tabular-cell"><label for="identity">Email/Username:</label></div>
                    <div class="tabular-cell"><?php echo form_input($identity); ?></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell"><label for="password">Password:</label></div>
                    <div class="tabular-cell"><?php echo form_input($password); ?></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell"><label for="remember">Remember Me:</label></div>
                    <div class="tabular-cell"><?php echo form_checkbox('remember', 'remember', $remember); ?></div>
                </div>

                <div class="tabular-row">
                    <div class="tabular-cell"></div>
                    <div class="tabular-cell"><?php echo form_submit('submit', 'Login'); ?></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell"></div>
                    <div class="tabular-cell"><?php echo anchor('auth/create_user', 'Create an account', 'title="Create an account"');?></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell"></div>
                    <div class="tabular-cell"><?php echo anchor('auth/forgot_password', 'Forgot password', 'title="Forgot password"');?></div>
                </div>
                <div class="tabular-row">
                    <div class="tabular-cell"></div>
                    <div class="tabular-cell"><?php echo anchor('auth/forgot_user_name', 'Forgot user name', 'title="Forgot user name"');?></div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
