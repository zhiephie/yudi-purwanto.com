<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title><?php echo $title; ?></title>
	<meta name="alexaVerifyID" content="0OjlcaUrLhnQAHbBGpgYRm1IcQA"/>
    	<meta name="robots" content="index, follow">
        <meta name="msvalidate.01" content="E3A810A08A682ACDD4558BF13CF99811" />
    	<meta name="google-site-verification" content="UOpX_fc2OA2ocmQyFRVWsuW29PBKMNnfiOMPQdbowfU"/>
    	<meta name="description" content="yudi-purwanto.com, Hanya tulisan seeorang web development biasa yang ingin berbagi ala kadarnya.">
    	<meta name="keywords" content="yudi-purwanto.com, web development, tutorial,  portfolio yudi purwanto, blog yudi purwanto">
    	<meta http-equiv="Copyright" content="yudi"/>
    	<meta name="author" content="Yudi Purwanto">
    	<meta content='id' name='geo.country'/>
    	<meta content='Jakarta' name='geo.placename'/>
    	<meta http-equiv="imagetoolbar" content="yes"/>
    	<meta name="language" content="Indonesia"/>
    	<meta name="revisit-after" content="7">
    	<meta name="webcrawlers" content="all"/>
    	<meta name="rating" content="general">
    	<meta name="spiders" content="all"/>
    	<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<meta name="twitter:card" content="webblog">
		<meta name="twitter:site" content="@str4whatt">
		<meta property="og:url" content="http://yudi-purwanto.com/about">
		<meta name="twitter:creator" content="@str4whatt">
		<meta name="twitter:title" content="Yudi Purwanto Web Development">
		<meta name="twitter:description" content="Yudi Purwanto Web Development — Hanya tulisan seeorang web development biasa yang ingin berbagi ala kadarnya.">
		<meta name="twitter:image:src" content="http://yudi-purwanto/assets/images/str4what1.jpg">
 
		<meta property="fb:admins" content="ezhoud1,str4whatt">
		<meta property="fb:app_id" content="374570645962030">
		<meta property="og:url" content="http://yudi-purwanto.com/about">
		<meta property="og:type" content="article">
		<meta property="og:title" content="Yudi Purwanto Web Development">
		<meta property="og:image" content="http://yudi-purwanto/assets/images/str4what1.jpg"/>
		<meta property="og:description" content="Yudi Purwanto Web Development — Hanya tulisan seeorang web development biasa yang ingin berbagi ala kadarnya.">
		<meta property="og:site_name" content="Yudi Purwanto">
		<meta property="article:author" content="https://www.facebook.com/str4whatt">
		<meta property="article:publisher" content="https://www.facebook.com/ezhoud1">

		<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png">
		<link rel=" " href="<?php echo base_url(); ?>analyticstracking.php">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/normalize.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/demo.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/component.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/complete.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/metro.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/faq/faq/faq.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/base.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/highslide.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.tagsinput.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prism.css"/>
	</head>
	<body>
	   <div class="load"></div>
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li class="gn-search-item">
									<?php echo form_open("search/result"); ?>
									<input placeholder="Searching" type="text" name="keyword" class="gn-search">
									<a class="gn-icon gn-icon-search"><span>Search</span></a>
									<?php echo form_close(); ?>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>tutorial" class="gn-icon gn-icon-article">Tutorials</a>
								</li>
								<li><a href="<?php echo base_url(); ?>project" class="gn-icon gn-icon-help">Project</a></li>
								<li>
									<a href="<?php echo base_url(); ?>ebooks" class="gn-icon gn-icon-download">E-Books</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>about" class="gn-icon gn-icon-cog">About</a>
								</li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href="<?php echo base_url(); ?>">YP-ID</a></li>
				<?php
				//session
				if($this->session->userdata('logged_in')!="")
				{
				?>
				<li><a class="codrops-icon codrops-icon-prev" href="<?php echo base_url();?>dashboard"><span>Dashboard</span></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="<?php echo base_url();?>auth/logout"><span>Logout</span></a></li>
				<?php
			    }else{ ?>
			    	<li><a class="codrops-icon codrops-icon-drop" href="<?php echo base_url();?>auth/signin"><span>Signin</span></a></li>
			    <?php } ?>
			</ul>