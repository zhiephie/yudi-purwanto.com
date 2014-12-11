<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Not Found</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="error yudi purwanto">
    <meta name="keywords" content="error yudi purwanto">
    <meta http-equiv="Copyright" content="yudi-purwanto">
    <meta name="author" content="Yudi Purwanto">
    <meta http-equiv="imagetoolbar" content="no">
    <meta name="language" content="Indonesia">
    <meta name="revisit-after" content="7">
    <meta name="webcrawlers" content="all">
    <meta name="rating" content="general">
    <meta name="spiders" content="all">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

	<link rel="stylesheet" href="<?php echo base_url();?>assets/zonk/default.css">
	<script src="<?php echo base_url();?>assets/zonk/jquery.js"></script>
</head>
<body>
<div class="est">
	<div class="main_content pos_rel">
		<script>
		$(function(){
			var bg_404 = "<?php echo base_url();?>assets/zonk/bg_404.jpg";
			var anim_404 = "<?php echo base_url();?>assets/zonk/anim_404.gif";
			$('<img src="'+ bg_404 +'">').load(function(){
				$('<img class="bg_404" src="'+ anim_404 +'" alt="">').appendTo('.main_content');
			});
		});
		</script>
	</div>
		<div class="copy">
			&copy; 2014, www.yudi-purwanto.com
		</div>
</div>

</body>
</html>