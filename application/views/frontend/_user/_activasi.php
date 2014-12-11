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
<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>
    <?php echo $message;?>
</strong>
</div>
</div>
</body>
</html>
