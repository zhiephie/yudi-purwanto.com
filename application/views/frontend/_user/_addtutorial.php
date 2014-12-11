<div class="main" id="main">
  <div class="container">
    <div id="content" class="col">
      <div class="row">
      	<div class="col-md-12">	
      			<div class="widget-header">
					<h3>Add Tutorial</h3>
				</div> <!-- /widget-header -->
				<script src="<?php echo base_url();?>assets/default/js/jquery.js"></script>
				<script type="text/javascript">
    				$(document).ready(function() {
    				check = $("#check");

    				check.click(function() {
    				    if ($(this).is(":checked")) {
    				        $("#submit").removeAttr("disabled");
    				    } else {
    				        $("#submit").attr("disabled", "disabled");
    				    }
    				});
  				}); 
    		    </script>
				<div class="widget-content">
				 <?php
      			//flash messages
      			if(isset($flash_message)){
       		    if($flash_message == TRUE)
        		{
         		 echo '<div class="alert alert-success">';
           		 echo '<a class="close" data-dismiss="alert">×</a>';
            	 echo '<strong>Well done!</strong> new tutorial created with success.';
          		 echo '</div>';       
        		}else{
         		 echo '<div class="alert alert-warning">';
           		 echo '<a class="close" data-dismiss="alert">×</a>';
            	 echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          		 echo '</div>';          
        		}
      			}
      			?>
				<?php
				$attributes = array('class' => 'form-horizontal col-md-ol', 'id' => '');
				$options = array('' => "Select");
      			foreach ($category as $row)
      			{
        		$options[$row['idcategorytutorial']] = $row['name'];
      			}
      			//form validation
      			echo validation_errors();
      
      			echo form_open_multipart('dashboard/add', $attributes);
      			?>
				    <br/>
						<fieldset>
          				<?php
							echo '<div class="form-group">';
							echo '<div class="col-lg-8">';
							echo form_dropdown('category_id', $options, set_value('category_id'), 'class="form-control"');
				            echo '</div>';
				          echo '</div>';
				          ?>
						    <div class="form-group">
								<div class="col-lg-8">
						        	<input type="text" placeholder="Title" class="form-control" name="title" id="">
								</div>
						    </div>
	
						    <div class="form-group">
						      <div class="col-lg-8">
						        <textarea id="area2" class="form-control" name="text" rows="5"></textarea>
						        </div>
						    </div>
							
						    <div class="form-group">
								<div class="col-lg-8">
						        	<input class="form-control tags" name="tags">
								</div>
						    </div>

							<div class="form-group">
								<div class="col-lg-8">
						        	<input type="file" name="userfile" id="" required>
						        	<p class="help-block">good size image width 1200 pixels and hight 500 pixels.</p>
								</div>
						    </div>
						
				         <div class="form-group">
						    <div class="col-lg-8">
            				<input type="checkbox" id="check" value="I agree"> please check
            				</div>

						    <div class="form-group">
						    	
						    	<div class="col-lg-8">
						    	<p class="help-block">wait publish from admin.</p>
						      <button id="submit" disabled="disabled" type="submit" class="btn btn-success"><i class="icon-ok"></i> Save</button>&nbsp;&nbsp;
						      <button type="reset" class="btn btn-default">Cancel</button>
						  </div>
						    </div>
						  </fieldset>
						<?php echo form_close(); ?>
				</div> <!-- /widget-content -->				
	        </div> <!-- /col-md-12 -->     	
         </div> <!-- /row -->
      </div>
    </div> <!-- /container -->
</div> <!-- /main -->
</div>