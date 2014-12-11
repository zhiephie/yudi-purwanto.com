<div id="main" class="clearfix">
	<div id="content" class="col">
<div class="page-header">
<h1>About Us</h1>
</div>
<?php foreach($authors as $value): ?>
<div id="grid">
	<div class="col-md-6">
		<div class="article-grid">
		   <a href="<?php echo base_url(); ?>author/id/<?php echo $value->login_id; ?>"><img class="img-responsived" src="<?php echo $value->images;?>" alt="<?php echo $value->name;?>"></a>
		<div class="article-grid-content clearfix">
			<h2><a href="<?php echo base_url(); ?>author/id/<?php echo $value->login_id; ?>"><?php echo $value->name;?></a></h2>
<p><?php echo $value->text;?>.</p>
<div class="about-actions">
<a class="sbg-twitter" href="<?php echo $value->twitter;?>" target="_blank">
	<span class="fa fa-twitter"></span>
</a>
<a class="sbg-google-plus" href="<?php echo $value->plus;?>" target="_blank">
	<span class="fa fa-google-plus"></span>
</a>
<a class="sbg-email" href="<?php echo $value->github;?>" target="_blank">
	<span class="fa fa-github"></span>
</a>
</div>
	</div>
</div>
</div>
	</div>
	<?php endforeach; ?>
<div id="pagination-links">
	<div class="pull-right">
<?php echo $paginator; ?>
</div>
	<div class="text-left">
</div>
	</div>
	</div>
</div>