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
    <script type="text/javascript">
    $(document).ready(function() {
    check = $("#check");

    check.click(function() {
        if ($(this).is(":checked")) {
            $("#submit").removeAttr("disabled");
        } else {
            $("#submit").attr("disabled", "disabled");
        }
    });
  }); 
    </script>
        <?php echo validation_errors(); ?>
    <div class="container">
         <?php echo form_open("user/create_member","class='form-signin'"); ?>   
            <h3 class="form-signin-heading">Create an account</h3>
            <div class="controls input-icon">
                <i class=" icon-user-md"></i>
                <input type="text" name="username" placeholder="Your username" class="input-block-level" autocomplete="off"/>
            </div>
            <div class=" controls input-icon">
                <i class="icon-fire"></i>
                <input type="text" name="email" placeholder="Your email" class="input-block-level" autocomplete="off"/>
            </div>
            <div class="controls input-icon">
                <i class=" icon-user"></i>
                <input type="text" name="name" placeholder="Your name" class="input-block-level" autocomplete="off"/>
            </div>
            <div class="controls input-icon">
                <i class=" icon-key"></i>
                <input type="password" name="password" placeholder="Your password" class="input-block-level" autocomplete="off"/>
            </div>
            <div class="controls input-icon">
                <i class=" icon-lock"></i>
                <input type="password" name="password2" placeholder="Confirm password" class="input-block-level" autocomplete="off"/>
            </div>
            <label class="checkbox">
            <input type="checkbox" id="check" value="I agree"><b>I agree</b>
            </label>
            <button class="btn btn-inverse btn-block" id="submit" disabled="disabled" type="submit">Sign up</button>
        <?php echo form_close(); ?>
    </div>
</div>
</body>
</html>
