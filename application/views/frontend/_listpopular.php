<div id="main" class="clearfix">
    <div id="content" class="col">
<div id="grid">
<?php
foreach($pop->result() as $value)
{
	$date = generate_tanggal($value->date);
	$isi = strip_tags(substr($value->text, 0,200));
	$pecah = explode('.', $value->image);
	$alt = $pecah[0];
?>
	<div id="post-<?php echo $value->idtutorial;?>" class="col-md-6">
		<div class="article-grid">
			<a class="article-img" href="<?php echo base_url();?>show/detail/<?php echo $value->slug;?>"><img width="1200" height="500" src="<?php echo base_url(); ?>assets/uploads/<?php echo $value->image; ?>" class="img-responsive wp-post-image" alt="<?php echo $alt;?>"/></a>
				<div class="article-cat">
					<a href="<?php echo base_url();?>category/show/<?php echo $value->slug_cat; ?>" title="View all posts <?php echo $value->name; ?>" rel="category tag"><?php echo $value->name; ?></a> </div>
						<div class="article-grid-content clearfix">
							<h2><a href="<?php echo base_url();?>show/detail/<?php echo $value->slug;?>"><?php echo $value->title;?></a></h2>
								<div class="byline row">
									<span class="byline-item col-sm-6">
								<a href="<?php echo base_url();?>author/id/<?php echo $value->author; ?>"><span class="li_user"></span> <?php echo $value->idlogin; ?></a></span>
							<span class="byline-item col-sm-6 text-right">
						<span class="li_calendar"></span> <?php echo $date; ?></span>
					</div>
				<div class="byline row">
			<span class="byline-item col-sm-4">
		<span class="li_bubble"></span>
	<a href="<?php echo base_url();?>show/detail/<?php echo $value->slug;?>#comment-section"><span class="dsq-postid" rel="<?php echo $value->idtutorial;?> http://scotch.io/?p=<?php echo $value->idtutorial;?>">16 Comments</span></a></span>
<span class="byline-item col-sm-8 text-right">
<span class="li_tag"></span> 
<?php 
$tags = explode(',', $value->tag);
foreach($tags as $tag){
?>
<a href="<?php echo base_url();?>tag/show/<?php echo $tag; ?>" rel="tag"><?php echo $tag; ?></a>
<?php } ?> 
</span>
</div> 
<p><p> <?php echo $isi; ?>&#8230;</p>
<div class="text-right">
<a href="<?php echo base_url();?>show/detail/<?php echo $value->slug;?>" class="read-more-btn btn btn-link btn-sm">Read More <span class="fa fa-chevron-right"></span></a>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
<div id="pagination-links">
<div class="pull-right">
<?php echo $paginator; ?>
</div>
<div class="text-left">
</div>
</div>
</div>
</div>