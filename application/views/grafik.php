<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        foreach($data as $data)
        {
            $merk[]=$data->merk;
            $stok[]=(float) $data->stok;
        }
    ?>
</head>
<body>
<!-- <canvas id="canvas" width="750" height="280"></canvas>

	<script>

            var lineChartData = {
                labels : <?php 
				//echo json_encode($merk);?>,
                datasets : [
                    
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data : <?php //echo json_encode($stok);?>
                    }

                ]
                
            }

        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
        
   	</script> -->
<div style="width: 800px;height: 700px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($merk) ?>,
				datasets: [{
					label: <?php echo json_encode($merk) ?>,
					data: <?php echo json_encode($stok) ?>,
					backgroundColor: [
					'rgba(43, 191, 56, 0.8)',
					'rgba(34, 139, 36, 0.8)',
					'rgba(30, 144, 255, 0.8)',
					'rgba(173, 255, 48, 0.8)',
					'rgba(147, 112, 219, 0.8)',
					'rgba(26, 128, 127, 0.8)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>