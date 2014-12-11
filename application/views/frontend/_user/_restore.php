<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url();?>assets/css/october.css" rel="stylesheet">
        <script src="<?php echo base_url();?>assets/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/framework.js"></script>
        <script src="<?php echo base_url();?>assets/js/october.utils.js"></script>
        <script src="<?php echo base_url();?>assets/js/vendor/modernizr.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/october.flashmessage.js"></script>
        <script src="<?php echo base_url();?>assets/js/auth/auth.js"></script>
    <?php echo validation_errors(); ?>
    </head>
    <body class="outer">
        <div id="layout-canvas">
            <div class="layout">
                <div class="layout-row min-size layout-head">
                </div>
                <div class="layout-row">
                    <div class="layout-cell">
                    <div class="outer-form-container">
                <div id="layout-flash-messages"></div>
            <h2>Enter your Email</h2>
        <?php echo form_open('auth/reset')?>
        <div class="form-elements" role="form">
        <div class="form-group text-field horizontal-form october">
            <input type="text" name="email" value="" class="form-control width-2 icon user" placeholder="your email" autocomplete="off" maxlength="255"/>
            <button type="submit" class="btn btn-primary restore-button">Restore</button>
        </div>
        <p class="pull-right forgot-password">
            <a href="<?php echo base_url();?>auth/signin" class="text-muted">Cancel</a>
        </p>
    </div>       
</div>
 </div>
    </div>
    </div>
        </div><!-- /layout-canvas -->
    </body>
</html>

