<div id="main" class="clearfix">
<div id="content" class="col">
<div id="grid">
<div class="page-header">
<h1>Our Work <small>These are some portfolio!</small></h1>
</div>
<?php foreach ($project->result() as $value)
{
	$isi = strip_tags(substr($value->text ,0,190));
	$pecah = explode(".", $value->image);
	$alt = $pecah[0];
?>
<div class="col-md-6">
<div class="article-grid">
<img width="1200" height="500" src="<?php echo base_url(); ?>assets/uploads/<?php echo $value->image; ?>" class="img-responsive wp-post-image" alt="<?php echo $alt;?>"/>
<span class="article-cat"><?php echo $value->name;?></span>
<div class="article-grid-content">
<h2><?php echo $value->title;?></h2>
<p><p><?php echo $isi;?></p>
<div class="work-actions text-center">
<div class="btn-group">
<a class="btn btn-sm btn-info" href="<?php echo base_url();?>project/show/<?php echo $value->slug;?>">
<span class="li_eye"></span> View
</a>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
<div id="pagination-links">
<div class="pull-right">
<?php echo $paginator; ?>
</div>
<div class="text-left">
</div>
</div>
</div>
</div>
</div>