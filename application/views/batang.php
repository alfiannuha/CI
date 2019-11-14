<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        foreach($merchant as $merchant)
        {
            //$kanwil=$merchant->kanwil;
            $stok1[]=(float) $merchant->total;
            $jenis1[0]=$merchant->jenis;
        }
        foreach($brilling as $brilling)
        {
            //$kanwil=$brilling->kanwil;
            $stok2[]=(float) $brilling->total;
            $jenis2[0]=$brilling->jenis;
        }
        foreach($uko as $uko)
        {
            $kanwil[]=$uko->kanwil;
            $stok3[]=(float) $uko->total;
            $jenis3[0]=$uko->jenis;
        }
    ?>
</head>
<body>
<!-- <canvas id="canvas" width="800" height="280"></canvas>

	<script>

            var barData = {
                labels : <?php 
				//echo json_encode($kanwil);?>,
                datasets : [
                    
                    {
                        label: <?php //echo json_encode($jenis) ?>,
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 0.3)",
                        data : <?php //echo json_encode($stok1);?>
                    },
                    {
                        label: <?php //echo json_encode($jenis) ?>,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 0.3)",
                        data : <?php //echo json_encode($stok2);?>
                    },
                    {
                        label: <?php //echo json_encode($jenis) ?>,
                        backgroundColor: "rgba(153, 102, 255, 0.2)",
                        borderColor: "rgba(153, 102, 255, 0.3)",
                        data : <?php //echo json_encode($stok3);?>
                    }

                ]
                
            }

        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barData);
        
   	</script> -->
<div style="width: 800px;height: 700px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($kanwil) ?>,
				datasets: [
                {
					label: <?php echo json_encode($jenis1) ?>,
					backgroundColor: "rgba(255, 40, 132, 1)",
                    borderColor: "rgba(255, 40, 132, 0.5)",
                    data : <?php echo json_encode($stok1);?>
				},
                {
					label: <?php echo json_encode($jenis2) ?>,
					backgroundColor: "rgba(153, 90, 255, 1)",
                    borderColor: "rgba(153, 90, 255, 0.5)",
                    data : <?php echo json_encode($stok2);?>
				},
                {
					label: <?php echo json_encode($jenis3) ?>,
					backgroundColor: "rgba(145, 60, 70, 1)",
                    borderColor: "rgba(145, 60, 70, 0.5)",
                    data : <?php echo json_encode($stok3);?>
				}
                ]
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