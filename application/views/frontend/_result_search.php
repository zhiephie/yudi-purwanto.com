<div id="main" class="clearfix">
<div id="content" class="col">
<ol class="page-header faq-list">			
<?php
if($kata==null)
{
	echo "<h1>Please <small>Insert Keyword!!!</small></h1>";
}
elseif(count($hasil)>0){
foreach ($hasil as $value) 
{
	$isi = strip_tags(substr($value['text'], 0,200));
?>
<li>
<h3><a href="<?php echo base_url();?>show/detail/<?php echo $value['slug'];?>"><?php echo $value['title'];?></a></h3>
<p><?php echo $isi;?>...</p>
</li>
<?php
}
}
else{
	echo "<h1>Keyword <small><b>".$kata."</b> Not Found.!!!</small></h1>";
}
?>
</ol>
</div>
</div>
<div id="pagination-links">
<?php echo $paginator; ?>
</div>