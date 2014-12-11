<?php 
foreach ($detail->result() as $value) 
{
    $date = generate_tanggal($value->date);
    $isi  = $value->text;
    //$isi  = hashtag($value->text);
    $pecah = explode(".", $value->image);
    $alt = $pecah[0];
?>
<div id="main" class="clearfix">
<div id="content" class="col">
<article class="post-<?php echo $value->idtutorial; ?> article single tiles" id="post-<?php echo $value->idtutorial; ?>">
<a href="#" class="toggle-reader-mode"><i class="fa"></i></a>
 
<img width="1200" height="500" src="<?php echo base_url(); ?>assets/uploads/<?php echo $value->image; ?>" class="img-responsive-content wp-post-image" alt="<?php echo $alt;?>" id="article-main-image"/>
 
<div class="article-cat">
<a href="<?php echo base_url();?>category/show/<?php echo $value->slug_cat; ?>" title="View all posts in <?php echo $value->name;?>" rel="category tag"><?php echo $value->name;?></a> </div>
 
<div class="article-content">
<div class="article-white">
<h1><?php echo $value->title;?></h1>
<div class="byline">
<span class="byline-item"><span class="li_user"></span> <a href="<?php echo base_url();?>author/id/<?php echo $value->author; ?>" title="Posts by <?php echo $value->idlogin;?>" rel="author"><?php echo $value->idlogin;?></a></span>
<span class="byline-item"><span class="li_calendar"></span> <?php echo $date;?></span>
<span class="byline-item"><span class="li_tag"></span> 
<?php 
$tags = explode(',', $value->tag);
foreach($tags as $tag){
?>
<a href="<?php echo base_url();?>tag/show/<?php echo $tag; ?>" rel="tag"><?php echo $tag; ?></a>
<?php } ?>
</span>
<span class="byline-item">
<span class="li_bubble">
<a href="#comment-section"><span class="dsq-postid" data-dsiqus-identifier="" rel="<?php echo $value->idtutorial; ?>"> Comments</span></a>
</span>
<span class="byline-item"><span class="li_eye"></span> <?php echo $value->counter;?> View</span>
</div>
<div class="tag">
      <p>&nbsp;</p>
        <p style="text-align: center;">
            <script language="javascript">
            document.write("<a class='tag' href='http://twitter.com/home/?status=" + document.URL + "' target='_blank'> Twitter</a>  <a href='http://www.facebook.com/share.php?u=" + document.URL + "' target='_blank'> Facebook</a>  <a href='http://www.reddit.com/submit?url=" + document.URL + "' target='_blank'> Reddit</a>  <a href='http://digg.com/submit?url=" + document.URL + "' target='_blank'> Digg</a>");
           </script>
        </p>
</div> <!-- End Tags -->
<div class="action-buttons">
<a class='btn btn-lg btn-info' href='<?php echo base_url(); ?>pdf/generate/<?php echo $value->slug; ?>'><span class='fa fa-file-o'></span> PDF</a> </div>
</div>
<div class="tile">
<div class="tile-content">
<p><?php echo $isi;?></p>
</div>
</div>
</div>
<?php
}
?>
<div id="article-secondary">
<div id="related-articles" class="text-center">
<div class='yarpp-related'>
<h3>Related Articles</h3>
<div class="row">
<?php foreach ($random->result() as $rand) 
{
    $pecah = explode(".", $value->image);
    $alt = $pecah[0];
?>
<div class="col-sm-4">
<a href="<?php echo base_url(); ?>show/detail/<?php echo $rand->slug; ?>"><img width="600" height="250" src="<?php echo base_url(); ?>assets/uploads/<?php echo $rand->image; ?>" class="img-responsived img-thumbnail post-image" alt="<?php echo $alt;?>"/></a>
<p><a href="<?php echo base_url(); ?>show/detail/<?php echo $rand->slug; ?>"><?php echo $rand->title;?></a></p>
</div>
<?php } ?>
<script type="text/javascript">
    // <![CDATA[
        var disqus_shortname = 'yudipurwanto';
        (function () {
            var nodes = document.getElementsByTagName('span');
            for (var i = 0, url; i < nodes.length; i++) {
                if (nodes[i].className.indexOf('dsq-postid') != -1) {
                    nodes[i].parentNode.setAttribute('data-disqus-identifier', nodes[i].getAttribute('rel'));
                    url = nodes[i].parentNode.href.split('#', 1);
                    if (url.length == 1) { url = url[0]; }
                    else { url = url[1]; }
                    nodes[i].parentNode.href = url + '#disqus_thread';
                }
            }
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + 'disqus.com/forums/' + disqus_shortname + '/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    //]]>
    </script>
</div>
</div>
</div>
<div id="author-info">
<div class="row">
<div class="col-sm-4">
<img alt='<?php  echo $value->idlogin;?>' src='<?php echo $value->images;?>' class='cycle' height='175' width='175'/> </div>
<div class="col-sm-8">
<h3><a href="<?php echo base_url();?>author/id/<?php echo $value->author; ?>" title="Posts by <?php  echo $value->idlogin;?>" rel="author"><?php echo $value->idlogin;?></a></h3>
<p><?php echo $value->tentang; ?>.</p>
<a id="view-contributions" class="btn btn-info btn-sm" href="<?php echo base_url();?>author/id/<?php echo $value->author; ?>">
<span class="fa fa-heart"></span> View My Contributions
</a>
<ul id="author-links" class="list-unstyled text-center">
<li id="twitter-link">
<a class="sbg-twitter" href="<?php echo $value->twitter;?>" target="_blank">
<span class="fa fa-twitter"></span>
</a>
</li>
<li id="google-link">
<a class="sbg-google-plus" href="<?php echo $value->plus;?>" target="_blank">
<span class="fa fa-google-plus"></span>
</a>
</li>
<li id="github-link">
<a class="sbg-github" href="<?php echo $value->github;?>" target="_blank">
<span class="fa fa-github"></span>
</a>
</li>
</ul>
</div>
</div>
</div>
<div id="stay-connected" class="text-center">
<div class="row">
<h4><span class="li_mail"></span></h4>
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
<div id="comment-section" class="white-content">
<div id="disqus_thread">
<div id="dsq-content">
<script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'yudipurwanto'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                     })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
</div>
</div>
<div class="article-ads text-center clearfix">
</div>
</div>
<div id="article-end">
<div class="page-header">
<h5>Popular E-books</h5>
</div>
<div class="row">
<?php foreach ($freebie->result() as $free) { ?>
<div class="col-sm-4">
<a href="<?php echo base_url();?>ebooks/get/<?php echo $free->idebook;?>">
<img src="<?php echo base_url(); ?>assets/images/freebie.jpg" alt="Yudi Purwanto" class="img-responsived">
</a>
<h4><a href="<?php echo base_url();?>ebooks/get/<?php echo $free->idebook;?>">
<?php echo $free->title;?>
</a></h4>
</div>
<?php } ?>
</div>
</div>
</div>