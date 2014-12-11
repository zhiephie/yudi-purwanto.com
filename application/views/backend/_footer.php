<!-- footer -->  
<div class="footer">	
	<div class="container">	
		<div class="row">	
			<div id="footer-copyright" class="col-md-6">
				&copy; 2012-13 Jumpstart UI.
			</div> <!-- /span6 -->
			
			<div id="footer-terms" class="col-md-6">
				Theme by <a href="http://jumpstartui.com" target="_blank">Jumpstart UI</a>
			</div> <!-- /.span6 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
	
</div> <!-- /footer -->
    
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/js/libs/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/libs/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Application.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/highcharts/themes/gray.js"></script> -->
<script src="<?php echo base_url(); ?>assets/highcharts/modules/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	window.onload = function () {
            CKEDITOR.replace('content', {
                "filebrowserBrowseUrl": "<?php echo base_url();?>backend/filemanager"
            });
        };
    // Tagsinput
    if($(".tags").length > 0)
       $(".tags").tagsInput({'width':'100%',
                              'height':'auto',
                              'onAddTag': function(text){
                                //action
                              },
                              'onRemoveTag': function(text){
                                //action
                              }});
});
</script>
  </body>
</html>