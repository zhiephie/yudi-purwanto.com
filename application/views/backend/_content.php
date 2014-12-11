<div class="main">
    <div class="container">
      <div class="row">
      	<div class="col-md-12">
			<div class="widget stacked widget-table action-table">
			  <a href="<?php echo base_url(); ?>backend/add"><div class="btn btn-default"><b> + Add</b></div></a>
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>List Tutorial</h3>
				</div> <!-- /widget-header -->
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
					
						<thead>
							<tr>
								<th>No</th>
								<th>Category</th>
								<th>Title</th>
								<th>Text</th>
								<th>Date</th>
								<th>Publish</th>
								<th>Author</th>
								<th>Counter</th>
								<th class="td-actions"></th>
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

				        $teks = "Aktifkan";
						$param = "yes";
						if($t->publish=='yes'){$status="Aktif"; $teks = "NonAktifkan"; $param='no';}
				        ?>
			        		 <tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $t->name;?></td>
								<td><?php echo $t->title;?></td>
								<td><?php echo strip_tags(substr($t->text, 0,100));?>...</td>
								<td><?php echo generate_tanggal($t->date);?></td>
								<td><?php echo $t->publish;?></td>
								<td><?php echo $t->idlogin;?></td>
								<td> <?php echo $t->counter;?></td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/set_pup/<?php echo $t->idtutorial;?>/<?php echo $param; ?>/" class='btn btn-sm btn-default'><?php echo $teks;?>									
								</a>
								 </td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/update/<?php echo $t->idtutorial;?>" data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit' class='btn btn-sm btn-default ui-tooltip'>
								  <i class='btn-icon-only icon-edit'></i>									
									</a>
								 </td>
								<td class='td-actions'>
								<a href="<?php echo base_url();?>backend/destroy/<?php echo $t->idtutorial;?>" 
									onclick="return confirm('Anda yakin ingin menghapus tutorial ini?')" data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete' class='btn btn-sm btn-default ui-tooltip'>
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
		echo "<td colspan='5'>Belum ada Data Tutorial</td>";
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