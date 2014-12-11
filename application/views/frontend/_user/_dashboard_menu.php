<div id="main" class="clearfix">
<div id="content" class="col">
       <div class="page-header">
			<i class="icon-bookmark"></i>
					<h3>Dashboard</h3>
				</div> <!-- /widget-header -->
				<div class="widget-content">
					<div class="shortcuts">
						<a href="<?php echo base_url();?>dashboard/add" class="shortcut">
							<i class="shortcut-icon icon-list-alt"></i>
							<span class="shortcut-label">Add Tutorial</span>
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-bookmark"></i>
							<span class="shortcut-label">Bookmarks</span>				
						</a>
						
						<a href="<?php echo base_url(); ?>dashboard/account/<?php echo $this->session->userdata('idlogin'); ?>" class="shortcut">
							<i class="shortcut-icon icon-user"></i>
							<span class="shortcut-label">Account</span>
						</a>
						
						<a href="<?php echo base_url(); ?>user/password" onclick="return hs.htmlExpand(this, { objectType: 'iframe' } )" class="shortcut">
							<i class="shortcut-icon icon-lock"></i>
							<span class="shortcut-label">Password</span>	
						</a>		
					</div> <!-- /shortcuts -->	
				</div> <!-- /widget-content -->