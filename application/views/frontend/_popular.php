<div class="sidebar-section clearfix text-center">
</div>
<div id="sidebar-secondary" class="col sidebar">
	<div class="sidebar-section clearfix">
	<h4>
	<!-- adsense here-->
	<a href="<?php echo base_url(); ?>popular"><span class="li_bulb"></span> Our Most Popular Articles</a></h4>
<?php
foreach($popular->result() as $get)
{
	$pecah = explode(".", $get->image);
	$alt = $pecah[0];
?>
	<div class="sidebar-article article-small text-center">
		<a href="<?php echo base_url(); ?>show/detail/<?php echo $get->slug; ?>"><img width="300" height="125" src="<?php echo base_url(); ?>assets/uploads/thumb/<?php echo $get->image; ?>" class="img-responsived wp-post-image" alt="<?php echo $alt;?>"/></a>
	<h3><a href="<?php echo base_url(); ?>show/detail/<?php echo $get->slug; ?>"><?php echo $get->title; ?></a></h3>
</div>
<?php
}
?>
</div>
<div id="mc_embed_signup">
<form action="http://scotch.us3.list-manage.com/subscribe/post?u=1c412c864c03eadaf07ccd61e&amp;id=a818d504d4" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
<div class="mc-field-group form-group">
<input type="email" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="Your Secret Electronic Address">
</div>
<div id="mce-responses" class="clear">
<div class="response" id="mce-error-response" style="display:none"></div>
<div class="response" id="mce-success-response" style="display:none"></div>
</div>  
<div style="position: absolute; left: -5000px;">
</div>
<div class="clear text-right"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-success btn-sm"></div>
</form>
</div>