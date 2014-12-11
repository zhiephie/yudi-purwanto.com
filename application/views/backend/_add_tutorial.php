<div class="main">
    <div class="container">
      <div class="row">
      	<div class="col-md-12">
      		<div class="widget stacked">
      			<div class="widget-header">
					<i class="icon-ok"></i>
					<h3>Add Tutorial</h3>
				</div> <!-- /widget-header -->
				
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
				$attributes = array('class' => 'form-horizontal col-md-7', 'id' => '');
				$options = array('' => "Select");
      			foreach ($category as $row)
      			{
        		$options[$row['idcategorytutorial']] = $row['name'];
      			}
      			//form validation
      			echo validation_errors();
      
      			echo form_open_multipart('backend/add', $attributes);
      			?>
				    <br/>
						<fieldset>
          				<?php
							echo '<div class="form-group">';
				            echo '<label for="category_id" class="col-lg-4">Category</label>';
							echo '<div class="col-lg-8">';

							echo form_dropdown('category_id', $options, set_value('category_id'), 'class="form-control"');
 
				            echo '</div>';
				          echo '</div>';
				          ?>
						    <div class="form-group">
						      <label for="title" class="col-lg-4">Title</label>
								<div class="col-lg-8">
						        	<input type="text" class="form-control" name="title" id="">
								</div>
						    </div>
	
						    <div class="form-group">
						      <label for="text" class="control-label">Text</label>
						      <div class="controls">
						        <textarea id="content" class="form-control" name="text" cols="50" rows="10"></textarea>
						        </div>
						    </div>
   							 <br>

						    <div class="form-group">
						      <label for="userfile" class="col-lg-4">Tags</label>
								<div class="col-lg-8">
						        	<input class="form-control tags" name="tags" row="5">
								</div>
						    </div>
						
							<div class="form-group">
						      <label for="userfile" class="col-lg-4">Image</label>
								<div class="col-lg-8">
						        	<input type="file" name="userfile" id="">
						        	<p class="help-block">good size image width 1200 pixels and hight 500 pixels.</p>
								</div>
						    </div>
							<br />
				         
						    <div class="form-group">
						    	<div class="col-lg-4"></div>
						    	<div class="col-lg-8">
						      <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Save</button>&nbsp;&nbsp;
						      <button type="reset" class="btn btn-default">Cancel</button>
						  </div>
						    </div>
						  </fieldset>
						<?php echo form_close(); ?>
					
				</div> <!-- /widget-content -->
			</div> <!-- /widget -->					
	    </div> <!-- /col-md-12 -->     	
      </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->