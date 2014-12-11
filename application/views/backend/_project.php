<div class="main">
    <div class="container">
      <div class="row">
      	<div class="col-md-12">	
			<div class="widget stacked widget-table action-table">
			  <a href="<?php echo base_url(); ?>backend/addproject"><div class="btn btn-default"><b> + Add</b></div></a>
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>List Project</h3>
				</div> <!-- /widget-header -->
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
					
						<thead>
							<tr>
								<th>No</th>
								<th>Category</th>
								<th>Title</th>
								<th>Text</th>
								<th>Image</th>
								<th>Date</th>
								<th>Author</th>
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
								<td><?php echo $t->name;?></td>
								<td><?php echo $t->title;?></td>
								<td><?php echo substr($t->text, 0,100);?>...</td>
								<td><?php echo substr($t->image, 0,10);?>.jpg</td>
								<td><?php echo generate_tanggal($t->date);?></td>
								<td>Yudi Purwanto</td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/portfolio/<?php echo $t->idproject;?>" data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit' class='btn btn-sm btn-default ui-tooltip'>
								  <i class='btn-icon-only icon-edit'></i>									
									</a>
								 </td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/destroy_project/<?php echo $t->idproject;?>" 
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
		echo "<td colspan='5'>Belum ada Data Portfolio</td>";
		}
	   ?>
	   <table><ul class="pager" style="text-align: center;"><li><?=$paginator;?></li></ul></table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						</table>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
								
	      </div> <!-- /span12 -->
      	
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->