<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Backend :: Dashboard :: Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">        
    <link href="<?php echo base_url(); ?>assets/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/base-admin-3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/base-admin-3-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/pages/dashboard.css" rel="stylesheet">   
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery.tagsinput.css" rel="stylesheet">
  </head>

<body>

<nav class="navbar navbar-inverse" role="navigation">

	<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <i class="icon-cog"></i>
    </button>
    <a class="navbar-brand" href="<?php echo base_url(); ?>backend/home">Dashboard</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
						
			<a href="javscript:;" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-cog"></i>
				Settings
				<b class="caret"></b>
			</a>
			
			<ul class="dropdown-menu">
				<li><a href="<?php echo base_url(); ?>backend/about">Data Account</a></li>
				<li><a href="<?php echo base_url(); ?>backend/users">Users</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
			</ul>
			
		</li>

		<li class="dropdown">
						
			<a class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-user"></i>
				<?php echo $this->session->userdata("username"); ?>
			</a>
			
			
			
		</li>
    </ul>
    
  </div><!-- /.navbar-collapse -->
</div> <!-- /.container -->
</nav>