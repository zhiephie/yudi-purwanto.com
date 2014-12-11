<div id="main" class="clearfix">
<div id="content" class="col">
<ol class="page-header faq-list">			
<?php
foreach ($tags as $value)
{
	$isi = strip_tags(substr($value->text, 0,200));
?>
<li>
<h3><a href="<?php echo base_url();?>show/detail/<?php echo $value->slug;?>"><?php echo $value->title;?></a></h3>
<p><?php echo $isi;?>...</p>
</li>
<?php
}
?>
</ol>
</div>
</div>