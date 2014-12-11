<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:content="http://purl.org/rss/1.0/modules/content/">

 
	<channel>
		<title><?php echo $feed_name; ?></title>
		<link><?php echo $feed_url; ?></link>
		<description><?php echo $page_description; ?></description>
		<dc:language><?php echo $page_language; ?></dc:language>
		<dc:creator><?php echo $creator_email; ?></dc:creator>
				
		<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
		<admin:generatorAgent rdf:resource="http://www.yudi-purwanto.com/" />

		<?php foreach($posts as $row):
			$date = generate_tanggal($row->date);
                ?>
			<item>
				<title><?php echo $row->title; ?></title>
				<link><?php echo site_url("show/detail/".$row->slug); ?></link>
				<pubDate><?php echo $date;?></pubDate>
				<description>
					<![CDATA[
						<div> <?php echo character_limiter($row->text, 200); ?></div>
						<p>This article is copyright &copy; <?php echo date('Y'); ?>&nbsp; <a href="http://www.yudi-purwanto.com">yudi-purwanto.com</a></p>
					]]>
				</description>
			</item>

		<?php endforeach; ?>

	</channel>
</rss>