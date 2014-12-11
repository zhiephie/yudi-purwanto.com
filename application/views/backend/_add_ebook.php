<div class="main">
    <div class="container">
      <div class="row"> 	
      	<div class="col-md-12"> 		
      		<div class="widget stacked">
      			<div class="widget-header">
					<i class="icon-ok"></i>
					<h3>Add File</h3>
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
      			//form validation
      			echo validation_errors();
      
      			echo form_open_multipart('backend/upload', $attributes);
      			?>
				    <br/>
						<fieldset>
						    <div class="form-group">
						      <label for="title" class="col-lg-4">Title</label>
								<div class="col-lg-8">
						        	<input type="text" class="form-control" name="title" id="">
								</div>
						    </div>
						
							<div class="form-group">
						      <label for="userfile" class="col-lg-4">File</label>
								<div class="col-lg-8">
						        	<input type="file" name="userfile" id="">
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
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>List File</h3>
				</div> <!-- /widget-header -->
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
					
						<thead>
							<tr>
								<th>No</th>
								<th>Title</th>
								<th>File</th>
								<th>Date</th>
								<th>Counter</th>
								<th class="td-actions"></th>
								<th class="td-actions"></th>
							</tr>
						</thead>
						<tbody>
				        <?php
				        $nomor=+1;
				        if(count($query->result())>0){
				        foreach($query->result() as $t)
				        {
				        ?>
			        		 <tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $t->title;?></td>
								<td><a href="<?php echo base_url();?>assets/ebooks/<?php echo $t->file;?>" target="_blank"><?php echo $t->file;?></a></td>
								<td><?php echo generate_tanggal($t->date);?></td>
								<td> <?php echo $t->counter;?></td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/edit/<?php echo $t->idebook;?>" data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit' class='btn btn-sm btn-default ui-tooltip'>
								  <i class='btn-icon-only icon-edit'></i>					
								</a>
								</td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/destroy_ebook/<?php echo $t->idebook;?>" 
									onclick="return confirm('Anda yakin ingin menghapus soal ini?')" data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete' class='btn btn-sm btn-default ui-tooltip'>
								  <i class='btn-icon-only icon-trash'></i>										
									</a>
								</td>
							</tr>
						</tbody>
						<?php
						$nomor++;
						}
						}
						else{
						echo "<td colspan='5'>Belum ada data ebook</td>";
						}
	  				 	?>
	   				<table><ul class="pager" style="text-align: center;"><li><?=$paginator;?></li></ul></table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></table>
				</div> <!-- /widget-content -->
			</div> <!-- /widget -->					
	    </div> <!-- /col-md-12 -->     	
      </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->