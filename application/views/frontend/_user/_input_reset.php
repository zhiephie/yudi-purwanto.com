<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="yudi-purwanto.com, Hanya tulisan seeorang web development biasa yang ingin berbagi ala kadarnya.">
<meta name="author" content="Yudi Purwanto">
<!-- styles -->
<link href="<?php echo base_url();?>assets/default/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/default/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/default/css/font-awesome.css">
<link href="<?php echo base_url();?>assets/default/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/default/css/theme-blue.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/default/css/aristo-ui.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/default/css/elfinder.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
<!--fav and touch icons -->
<link rel="shortcut icon" href="">
<!--============j avascript===========-->
<script src="<?php echo base_url();?>assets/default/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/default/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/default/js/bootstrap.js"></script>
</head>
<body>
<div class="layout">
    <!-- Navbar================================================== -->
    <div class="navbar navbar-inverse top-nav">
        <div class="navbar-inner">
            <div class="container">
                <span class="home-link"><a href="<?php echo base_url();?>" class="icon-home"></a></span>
                <div class="btn-toolbar pull-right notification-nav">
                    <div class="btn-group">
                        <div class="dropdown">
                            <a href="<?php echo base_url();?>auth/signin" class="btn btn-notification"><i class="icon-signin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php echo validation_errors(); ?>
    <div class="container">
         <?php echo form_open("user/update_reset","class='form-signin'"); ?>
           <input type="hidden" name="kode" value="<?php echo $kode; ?>" />
            <h3 class="form-signin-heading">Reset password</h3>
            <div class="controls input-icon">
                <i class=" icon-key"></i>
                <input type="password" name="password" placeholder="New password" class="input-block-level" autocomplete="off" required/>
            </div>
            <div class="controls input-icon">
                <i class=" icon-lock"></i>
                <input type="password" name="password2" placeholder="Confirm password" class="input-block-level" autocomplete="off" required/>
            </div>
            <label class="checkbox">
            <input type="checkbox" name="" value="I agree"/><b>I agree</b>
            </label>
            <button class="btn btn-inverse btn-block" type="submit">Reset</button>
        <?php echo form_close(); ?>
    </div>
</div>
</body>
</html>
