<div class="main">
    <div class="container">
      <div class="row">    	
      	<div class="col-md-6 col-xs-12">    		
     		<div class="widget stacked">				
				<div class="widget-header">
					<i class="icon-star"></i>
					<h3>Quick Count</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div id="chart-stats" class="stats">
						
						<div class="stat stat-chart">							
							<div id="donut" class="chart-holder"></div>						
						</div> <!-- /substat -->
						
						<div class="stat stat-time">									
							<span class="stat-value">(<?php echo $this->db->count_all('login');?>)</span>
							Count Users
						</div> <!-- /substat -->
						
					</div> <!-- /substats -->
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->	
			
			
			<div class="widget widget-nopad stacked">
						
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>Recent Popular</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<ul class="news-items">
						<?php
							$q = $this->db->query("SELECT title, slug, text, counter FROM tutorial ORDER BY counter DESC LIMIT 2");
							foreach($q->result() as $value):
							?>
						<li>
							<div class="news-item-detail">										
								<a href="<?php echo base_url(); ?>show/detail/<?php echo $value->slug; ?>" target="_blank" class="news-item-title"><?php echo $value->title; ?></a>
								<p class="news-item-preview"><?php echo substr($value->text, 0,75); ?>...</p>
							</div>
							<div class="news-item-date">
								<span class="news-item-day"><?php echo $value->counter; ?></span>
								<span class="news-item-month">Counter</span>
							</div>
						</li>
						<?php
						endforeach
						?>
					</ul>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->	
      		
	    </div> <!-- /span6 -->
  <script src="<?php echo base_url(); ?>assets/highcharts/jquery-1.7.2.min.js" type="text/javascript"></script>
  <script type="text/javascript">
      $(function(){
      new Highcharts.Chart({
          chart: {
          renderTo: 'chart',
          type: 'pie',
      },
          title: {
          text: 'Report Tutorial',
          x: -20
      },
          subtitle: {
          text: 'yudi-purwanto.com',
          x: -20
      },
      plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '<b>{categories.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'white'
                    }
                }
            }
        },
           series: [{
           name: 'Report Tutorial',
           data: <?php echo json_encode($data); ?>
           }]
        });
      }); 
  </script>

  <script type="text/javascript">
    $(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        $('#donut').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            exporting: {
                enabled: false
            },
            series: [{
                type: 'pie',
                name: 'Count',
                data: [
                    ['tutorial', <?php echo $this->db->count_all('tutorial');?>],
                    ['project',  <?php echo $this->db->count_all('project');?>],
                    // {
                    //     name: 'visit',
                    //     y: 12.8,
                    //     sliced: true,
                    //     selected: true
                    // },
                    ['ebook', <?php echo $this->db->count_all('ebook');?>]
                ]
            }]
        });
    });
    
});
		</script>
      	
      	<div class="col-md-6">	
      		
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-bookmark"></i>
					<h3>Quick Shortcuts</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="shortcuts">
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-list-alt"></i>
							<span class="shortcut-label">Apps</span>
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-bookmark"></i>
							<span class="shortcut-label">Bookmarks</span>								
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-signal"></i>
							<span class="shortcut-label">Reports</span>	
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-comment"></i>
							<span class="shortcut-label">Comments</span>								
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-user"></i>
							<span class="shortcut-label">Users</span>
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-file"></i>
							<span class="shortcut-label">Notes</span>	
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-picture"></i>
							<span class="shortcut-label">Photos</span>	
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-tag"></i>
							<span class="shortcut-label">Tags</span>
						</a>				
					</div> <!-- /shortcuts -->	
				
				</div> <!-- /widget-content -->
				
			</div> <!-- /widget -->

			<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-signal"></i>
					<h3>Report</h3>
				</div> <!-- /widget-header -->

				<div class="widget-content">					
					<div id="chart" class="chart-holder"></div>					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
								
	      </div> <!-- /span6 -->
      	
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->