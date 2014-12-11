<div id="main" class="clearfix">
<div id="content" class="col">
<?php foreach ($show->result() as $value) {
    $date = generate_tanggal($value->date);
    $pecah = explode(".", $value->image);
    $alt = $pecah[0];
?>
<article class="post-<?php echo $value->idproject;?> article single" id="post-<?php echo $value->idproject;?>">
<a href="#" class="toggle-reader-mode"><i class="fa"></i></a>
<img width="1200" height="500" src="<?php echo base_url(); ?>assets/uploads/<?php echo $value->image; ?>" class="img-responsive-content wp-post-image" alt="<?php echo $alt; ?>" id="article-main-image"/>
<div class="article-cat">
<?php echo $value->name;?>
</div>
<div class="article-content">
<h1><?php echo $value->title;?></h1>
<div class="byline">
<span class="byline-item"><span class="li_calendar"></span> <?php echo $date;?></span>
</div>
<div class="action-buttons">
<p><?php echo $value->text;?></p>
</div>
</article>
<?php } ?>
<div id="article-secondary">
<div id="related-articles" class="text-center">
<div class='yarpp-related'>
<h3>Random Articles</h3>
<div class="row">
<?php foreach ($random->result() as $rand) 
{
    $pecah = explode(".", $value->image);
    $alt = $pecah[0];
?>
<div class="col-sm-4">
<a href="<?php echo base_url(); ?>show/detail/<?php echo $rand->slug; ?>"><img width="600" height="250" src="<?php echo base_url(); ?>assets/uploads/<?php echo $rand->image; ?>" class="img-responsive img-thumbnail post-image" alt="<?php echo $alt;?>"/></a>
<p><a href="<?php echo base_url(); ?>show/detail/<?php echo $rand->slug; ?>"><?php echo $rand->title;?></a></p>
</div>
<?php } ?>
</div>
</div>
</div>
<div id="stay-connected" class="text-center">

<div class="row">
<h4><span class="li_mail"></span></h4>
<p>Get valuable tips, articles, and resources straight to your inbox. Every Tuesday.</p>
<div class="col-sm-6 col-sm-offset-3">
 
<div id="mc_embed_signup">
<form action="http://yudi-purwanto.us8.list-manage.com/subscribe/post?u=f2f0782b4fb6e215ceb561364&amp;id=368be87ea8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
<div class="mc-field-group form-group">
<input type="email" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="Your Secret Electronic Address">
</div>
<div id="mce-responses" class="clear">
<div class="response" id="mce-error-response" style="display:none"></div>
<div class="response" id="mce-success-response" style="display:none"></div>
</div>  
<div style="position: absolute; left: -5000px;"><input type="text" name="b_f2f0782b4fb6e215ceb561364_368be87ea8" value=""></div>
<div class="clear text-center"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-warning btn-sm"></div>
</form>
</div>
 
</div>
</div>
</div>
<div class="article-ads text-center clearfix">
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4625466825098355" data-ad-slot="6445191424" data-ad-format="auto"></ins>
<div id="article-end">
<div class="page-header">
<h5>Popular E-books</h5>
</div>
<div class="row">
<?php foreach ($freebie->result() as $free) { ?>
<div class="col-sm-4">
<a href="<?php echo base_url();?>ebooks/get/<?php echo $free->idebook;?>">
<img src="<?php echo base_url(); ?>assets/images/freebie.jpg" class="img-responsived">
</a>
<h4><a href="<?php echo base_url();?>ebooks/get/<?php echo $free->idebook;?>">
<?php echo $free->title;?>
</a></h4>
</div>
<?php } ?>
</div>
</div>
</div>