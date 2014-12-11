<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
        <title><?php echo $title;?></title>
        <link href="<?php echo base_url();?>assets/css/october.css" rel="stylesheet">
        <script src="<?php echo base_url();?>assets/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/framework.js"></script>
        <script src="<?php echo base_url();?>assets/js/october.utils.js"></script>
        <script src="<?php echo base_url();?>assets/js/october.flashmessage.js"></script>
   <?php
   if(isset($message_error) && $message_error){ ?>
       <p data-control="flash-message" class="error" data-interval="5">
       Incorrect username and password. Letters must be typed in the correct case.
       </p>
    <?php      
    }
    ?>
    </head>
    <body class="outer signin preload">
        <div id="layout-canvas">
            <div class="layout">
                <div class="layout-row min-size layout-head">
                 
                    <div class="layout-cell">
                        <div class="outer-form-container">
                            <div id="layout-flash-messages"></div>
    <?php echo form_open("signin/set"); ?>
    <div class="form-elements" role="form">
        <div class="form-group text-field horizontal-form october">
            <!-- Login -->
            <input type="text" name="username" value="" class="form-control width-1 icon user" placeholder="username" autocomplete="off" maxlength="255"/>
            <!-- Password -->
            <input type="password" name="password" value="" class="form-control width-1 icon lock" placeholder="password" autocomplete="off" maxlength="255"/>
            <button type="submit" class="btn btn-primary login-button">Login</button>
        </div>
        <?php echo form_close(); ?>
         <p class="oc-icon-th pull-left forgot-password">
            <!-- Create account -->
            <a href="<?php echo base_url();?>auth/signup" class="text-muted">Create account</a>
        </p>
        <p class="oc-icon-lock pull-right forgot-password">
            <!-- Forgot your password? -->
            <a href="<?php echo base_url();?>auth/restore" class="text-muted">Forgot your password?</a>
        </p>
        <!-- Submit Login -->
    </div>        
    </div>    
</div> 
 </div>
      </div>
        </div><!-- /layout-canvas -->
    </body>
</html>

