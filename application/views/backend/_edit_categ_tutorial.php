<div class="main">
    <div class="container">
      <div class="row">   	
      	<div class="col-md-12">    		
      		<div class="widget stacked">
     			<div class="widget-header">
					<i class="icon-ok"></i>
					<h3>Edit Category</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
				 <?php
      			//flash messages
                if($this->session->flashdata('flash_message')){
                if($this->session->flashdata('flash_message') == 'updated')
        		{
         		 echo '<div class="alert alert-success">';
           		 echo '<a class="close" data-dismiss="alert">×</a>';
            	 echo '<strong>Well done!</strong> category updated with success.';
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
      			//form validation
      			echo validation_errors();
      
      			echo form_open('backend/editcateg/'.$this->uri->segment(3).'', $attributes);
      			?>
				    <br/>
						<fieldset>
						    <div class="form-group">
						      <label for="name" class="col-lg-4">Name</label>
								<div class="col-lg-8">
						        	<input type="text" class="form-control" name="name" id="" value="<?php echo $categ[0]['name']; ?>">
								</div>
						    </div>
							<br />	         
						    <div class="form-group">
						    	<div class="col-lg-4"></div>
						    	<div class="col-lg-8">
						      <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Update</button>&nbsp;&nbsp;
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