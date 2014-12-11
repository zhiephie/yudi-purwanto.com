<div class="main">
    <div class="container">
      <div class="row">    	     	
      	<div class="col-md-12">	   					
			<div class="widget stacked widget-table action-table">
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>User</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
								<th>Aktif</th>
								<th>Hit</th>
								<th class="td-actions"></th>
								<th class="td-actions"></th>
							</tr>
						</thead>
						<tbody>
				<?php
				$nomor=+1;
				if(count($user->result())>0){
				foreach($user->result() as $k)
				{		
						$teks = "Aktifkan";
						$param = "1";
						if($k->active==1){$status="Aktif"; $teks = "NonAktifkan"; $param=0;}
						echo"<tr>
								<td>".$nomor."</td>
								<td>".$k->username."</td>
								<td>".$k->name."</td>
								<td>".$k->email."</td>
								<td>".$k->status."</td>
								<td>".$k->active."</td>
								<td>".$k->hit."</td>
								<td class='td-actions'>
								<a href='".base_url()."backend/set/".$k->idlogin."/".$param."' class='btn btn-sm btn-default'>".$teks."									
								</a>
								 </td>
								<td class='td-actions'>
								<a href='".base_url()."backend/deluser/".$k->idlogin."' onClick=return confirm('Anda yakin ingin menghapus user ini?') data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus user ".$k->name."' class='btn btn-sm btn-default ui-tooltip'>
								  <i class='btn-icon-only icon-trash'></i>										
									</a>
								</td>
							</tr>
						</tbody>";
			$nomor++;	
			}
		}
		else{
		echo "<td colspan='5'>Belum ada User</td>";
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