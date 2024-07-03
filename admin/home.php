<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>
<!-- BAR CHART -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Top 10 Frequent Questions</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="chart">
      <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
<?php

$questions = $conn->query("SELECT * FROM `questions` where id in (SELECT question_id from frequent_asks) ");
$list = array();
while($row = $questions->fetch_assoc()){
  $count = $conn->query("SELECT * FROM frequent_asks where question_id = {$row['id']} ")->num_rows;
  $list[] = array("count"=>$count,"question" =>$row['question']); // Changed key to index
}

usort($list, function($a, $b) {
  return $b['count'] - $a['count'];
});

$label = array();
$data = array();
$i = 10; // Set limit to top 10
foreach($list as $k => $v){
  $i--;
  $label[] = $v['question'];
  $data[] = $v['count'];
  if($i == 0)
    break;
}
?>
<script>
	$(function() {
		var areaChartData = {
      labels  : ['<?php echo implode('\',\'',$label) ?>'],
      datasets: [
        {
          label               : 'Frequent Asks',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo implode(',',$data) ?>]
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
		 //-------------
	    //- BAR CHART -
	    //-------------
	    var barChartCanvas = $('#barChart').get(0).getContext('2d')
	    var barChartData = $.extend(true, {}, areaChartData)
	    var temp0 = areaChartData.datasets[0]
	    barChartData.datasets[0] = temp0

	    var barChartOptions = {
	      responsive              : true,
	      maintainAspectRatio     : false,
	      datasetFill             : false
	    }

	    new Chart(barChartCanvas, {
	      type: 'bar',
	      data: barChartData,
	      options: barChartOptions
	    })

	})
</script>
<script>
	$(function() {
		var areaChartData = {
      labels  : ['<?php echo implode('\',\'',$label) ?>'],
      datasets: [
        {
          label               : 'Frequent Asks',
          backgroundColor     : [
            'rgba(60,141,188,0.9)',
            'rgba(210, 214, 222, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(231, 233, 237, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(201, 203, 207, 1)'
          ],
          borderColor         : [
            'rgba(60,141,188,1)',
            'rgba(210, 214, 222, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 205, 86, 1)',
            'rgba(231, 233, 237, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(201, 203, 207, 1)'
          ],
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo implode(',',$data) ?>]
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
		 //-------------
	    //- BAR CHART -
	    //-------------
	    var barChartCanvas = $('#barChart').get(0).getContext('2d')
	    var barChartData = $.extend(true, {}, areaChartData)
	    var temp0 = areaChartData.datasets[0]
	    barChartData.datasets[0] = temp0

	    var barChartOptions = {
	      responsive              : true,
	      maintainAspectRatio     : false,
	      datasetFill             : false
	    }

	    new Chart(barChartCanvas, {
	      type: 'bar',
	      data: barChartData,
	      options: barChartOptions
	    })

	})
</script>
