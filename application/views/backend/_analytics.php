 <div class="main">
    <div class="container">
      <div class="row">
      	<div class="col-md-12">
      		<div class="widget stacked">
      			<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Visitor</h3>
				</div> <!-- /widget-header -->
<!-- tableau pour les villes -->		
		<?php if(isset($cities) && is_array($cities)): ?>
		    <table class="table table-striped table-bordered">
		    	<thead>
		    		<tr>
		    			<th>City (<?=$cities['summary']->totalResults?>)</th>
		    			<th>Visitor (<?=$cities['summary']->metrics->visits?>)</th>
		    			<th>Pages view (<?=$cities['summary']->metrics->pageviews?>)</th>
		    		</tr>
		    	</thead>
		    	
		    	<tbody>
		    	<?php foreach ($cities as $key => $city): if ($key != 'summary'):?>
		    		<tr>
		    			<td><?=$key?></td>
		    			<td><?=$city->visits?></td>
		    			<td><?=$city->pageviews?></td>
		    		</tr>
		    	<?php endif; endforeach ?>
		    	</tbody>
		    		
		    	<?php if (isset($pagination)): ?>
		    	    <tfoot>
		    	    	<tr>
		    	    		<td colspan="3"><?=$pagination?></td>
		    	    	</tr>
		    	    </tfoot>
		    	<?php endif?>
		    
		    </table>
		<?php endif ?>
		
<!-- tableau pour les site référents -->
		<?php if(isset($referrers) && is_array($referrers)): ?>
		    <table class="table table-striped table-bordered">
		    	<thead>
		    		<tr>
		    			<th>Site referents (<?=$referrers['summary']->totalResults?>)</th>
		    			<th>Visitor (<?=$referrers['summary']->metrics->visits?>)</th>
		    			<th>Pages view (<?=$referrers['summary']->metrics->pageviews?>)</th>
		    		</tr>
		    	</thead>
		    	
		    	<tbody>
		    	<?php foreach ($referrers as $key => $ref): if ($key != 'summary'):?>
		    		<tr>
		    			<td><?=$key?></td>
		    			<td><?=$ref->visits?></td>
		    			<td><?=$ref->pageviews?></td>
		    		</tr>
		    	<?php endif; endforeach ?>
		    	</tbody>
		    
		    </table>
		<?php endif ?>
		
<!-- Listes pour les comptes -->
		<?php if(isset($accounts)): ?>
		<ol>
			<?php foreach ($accounts as $name => $value):?>
				<?php if ($name == 'segments'):?>
					<li><h4><?=$name?></h4>
						<ul>
							<?php foreach ($value as $segid => $segname):?>
								<li><?=$segid?> : <?=$segname?></li>
							<? endforeach?>
						</ul>
					</li>

				<?php else: ?>
					<li><h4><?=anchor('analytics/accounts'.'/'.$value->profileId, $name)?></h4>
						<ul>
							<li>title: <?=$value->title?></li>
							<li>ID: <?=$value->tableId?></li>
							<li>ID account: <?=$value->accountId?></li>
							<li> Nome: <?=$value->accountName?></li>
							<li>ID profil: <?=$value->profileId?></li>
							<li>Tracker: <?=$value->webPropertyId?></li>
						</ul>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		</ol>
		<?php endif ?>
		</div> <!-- /widget-content -->
		</div> <!-- /widget -->					
	    </div> <!-- /col-md-12 -->     	
      </div> <!-- /row -->
    </div> <!-- /container -->
</div> <!-- /main -->