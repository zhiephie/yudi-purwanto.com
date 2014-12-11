<div class="main" id="main">
    <div class="container">
      <div id="content" class="col">
      <div class="row">
      	<div class="col-md-12">
      			<div class="widget-header">
					<h3>Edit Tutorial</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
				 <?php
      			//flash messages
                if($this->session->flashdata('flash_message')){
                if($this->session->flashdata('flash_message') == 'updated')
        		{
         		 echo '<div class="alert alert-success">';
           		 echo '<a class="close" data-dismiss="alert">×</a>';
            	 echo '<strong>Well done!</strong> tutorial updated with success.';
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
				if(!(empty($category)))
				{
      			foreach ($category as $row)
      			{
        		$options[$row['idcategorytutorial']] = $row['name'];
      			}
      			}
      			//form validation
      			echo validation_errors();
      
      			echo form_open_multipart('dashboard/update/'.$this->uri->segment(3).'', $attributes);
      			?>
				    <br/>
						<fieldset>
          				<?php
							echo '<div class="form-group">';
							echo '<div class="col-lg-8">';
							echo form_dropdown('category_id', $options, $tutorial[0]['id_category'], 'class="form-control"');
				            echo '</div>';
				          echo '</div>';
				          ?>
						    <div class="form-group">
								<div class="col-lg-8">
						        	<input type="text" class="form-control" name="title" id="" value="<?php echo $tutorial[0]['title']; ?>">
								</div>
						    </div>
	
						    <div class="form-group">
						      <div class="col-lg-8">
						        <textarea id="area2" class="form-control" name="text" rows="4"><?php echo $tutorial[0]['text']; ?></textarea>
						        </div>
						    </div>
						
							<div class="form-group">
								<div class="col-lg-8">
						        	<input type="file" name="userfile" id="" value="<?php echo $tutorial[0]['image']; ?>">
						        	<p class="help-block">good size width 1200 px and hight 500 px</p>
								</div>
						    </div>

						    <div class="form-group">
								<div class="col-lg-2">
						        	<?php echo $gambar;?>
								</div>
						    </div>
						           
						    <div class="form-group">
						    	<div class="col-lg-8">
						      <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Update</button>&nbsp;&nbsp;
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