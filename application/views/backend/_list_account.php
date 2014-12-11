<div class="main">
    <div class="container">
      <div class="row"> 	
      	<div class="col-md-12"> 		
      		<div class="widget stacked">
      			<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Data Account</h3>
				</div> <!-- /widget-header -->
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Text</th>
								<th>Image</th>
								<th>Twitter</th>
								<th>Google+</th>
								<th>Github</th>
								<th class="td-actions"></th>
							</tr>
						</thead>
						<tbody>
				        <?php
				        $nomor=+1;
				        if(count($d->result())>0){
				        foreach($d->result() as $t)
				        {
				        ?>
			        		 <tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $t->name;?></td>
								<td><?php echo $t->text;?></td>
								<td><?php echo substr($t->images, 0, 25);?>...</td>
								<td><?php echo $t->twitter;?></td>
								<td><?php echo $t->plus;?></td>
								<td><?php echo $t->github;?></td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/account/<?php echo $t->idabout;?>" data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit' class='btn btn-sm btn-default ui-tooltip'>
								  <i class='btn-icon-only icon-edit'></i>					
								</a>
								</td>
							</tr>
						</tbody>
						<?php
						$nomor++;
						}
						}
						else{
						echo "<td colspan='5'>Belum ada data category</td>";
						}
	  				 	?>
	   				<table><ul class="pager" style="text-align: center;"><li></li></ul></table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></table>
				</div> <!-- /widget-content -->
			</div> <!-- /widget -->					
	    </div> <!-- /col-md-12 -->     	
      </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->