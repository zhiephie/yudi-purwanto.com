<?php 
foreach ($detail->result() as $value) 
{
    $date = generate_tanggal($value->date);
    $isi  = $value->text;
    $pecah = explode(".", $value->image);
    $alt = $pecah[0];
?>
<div id="main" class="clearfix">
<div id="content" class="col">
<article class="post-<?php echo $value->idtutorial; ?> article single tiles" id="post-<?php echo $value->idtutorial; ?>">
<a href="#" class="toggle-reader-mode"><i class="fa"></i></a>
 
<img width="540" height="300" src="<?php echo base_url(); ?>assets/uploads/<?php echo $value->image; ?>" class="img-responsive-content wp-post-image" alt="<?php echo $alt;?>" id="article-main-image"/>
 
<div class="article-cat">
<br/>
Category : <a href="<?php echo base_url();?>category/show/<?php echo $value->slug_cat; ?>" title="View all posts in <?php echo $value->name;?>" rel="category tag"><?php echo $value->name;?></a> </div>
 
<div class="article-content">
<div class="article-white">
<h1><?php echo $value->title;?></h1>
<div class="byline">
<span class="byline-item"><span class="li_user"></span>Author : <a href="<?php echo base_url();?>author/id/<?php echo $value->author; ?>" title="Posts by <?php echo $value->idlogin;?>" rel="author"><?php echo $value->idlogin;?></a></span>
<span class="byline-item"><span class="li_calendar"></span> <?php echo $date;?></span>
<span class="byline-item"><span class="li_tag"></span> 
<?php 
$tags = explode(',', $value->tag);
foreach($tags as $tag){
?>
Tags : <a href="<?php echo base_url();?>tag/show/<?php echo $tag; ?>" rel="tag"><?php echo $tag; ?></a>
<?php } ?>
</span>
<span class="byline-item">
<span class="li_bubble"></span>
<a href="#comment-section"><span class="dsq-postid" rel="<?php echo $value->idtutorial; ?> <?php echo base_url(); ?>show/detail/<?php echo $value->slug; ?>">Comments</span></a>
</span>
<span class="byline-item"><span class="li_eye"></span> <?php echo $value->counter;?> View</span>
</div>
<div class="tile">
<div class="tile-content">
<br/>
<p><?php echo $isi;?></p>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>