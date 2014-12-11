<div id="footer">
<style type="text/css">
p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
</style>
<br>
<a href="http://www.yudi-purwanto.com/cluethorough.php">Visit</a>
<script data-name="zhiephie" src="http://nodejs.in/octocard/bin/octocard.js"></script>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
		<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/classie.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/gnmenu.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/complete.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/prism.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/all.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/faq/faq.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/faq/faq/faq.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/modernizr.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/highslide-with-html.js"></script>  
                <script type="text/javascript">
		$(window).load(function(){$('.load').fadeOut(3000);return false;});
		</script>
		<script>
         hs.graphicsDir = 'http://yudi-purwanto.com/assets/graphics/';
         hs.outlineType = 'rounded-white';
         hs.wrapperClassName = 'draggable-header';
        </script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.tagsinput.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			window.onload = function () {
            CKEDITOR.replace('area2');
        };
		    // Tagsinput
		    if($(".tags").length > 0)
		       $(".tags").tagsInput({'width':'100%',
                              'height':'40',
                              'onAddTag': function(text){
                                //action
                              },
                              'onRemoveTag': function(text){
                                //action
                              }});
		});
		</script>
         <!-- Load js libs only when the page is loaded. -->
         <script>
           (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
           (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
           m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
           })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-47711050-1', 'yudi-purwanto.com');
          ga('send', 'pageview');
        </script>
	</body>
</html>