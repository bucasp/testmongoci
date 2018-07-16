<?php $datawew[0] = array(); ?>

<?php $i=1; $j=0;//echo count($hasil3d);//echo json_encode($hasil3d); 
foreach($hasil3d as $row2): ?>
		<?php //print_r($row2); 
		$datawew[$j] = array(); ?>
		
		<div>
		<table border = 1>
		<thead>
			<tr>
				<td>No</td>
				<td>Kategori</td>
				<td>Bulan</td>
				<td>Node Id</td>
				<td>Nilai rata-rata</td>
			</tr>
		</thead>

		<tbody>
		<?php $i=1; //$j=0;//echo count($hasil3d);echo json_encode($hasil3d); 
		foreach($row2 as $row): ?>
		<tr>   
			<?php //print_r($row); //print_r($row[0]);?>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['_id']['kategori']; ?></td>
			<td><?php echo $row['_id']['month']; ?></td>
			<td><?php echo $row['_id']['nodeid']; ?></td>
			<td><?php echo $row['average']; ?></td>
			<?php //if ($i>=10){break;};
					array_push($datawew[$j],$row['average']);?>
		</tr>
		<?php 
		$i++;//$j++;
		//echo count($datawew[$j]);
		endforeach; ?>
		</tbody>
		</table>
		</div>
<?php 
//$i++;
$j++;
endforeach; ?>

<?php $i=1; $j=0;//echo count($hasil3d);//echo json_encode($hasil3d); 
foreach($hasil3d2 as $row2): ?>
		<?php //print_r($row2); 
		$datawew2[$j] = array(); ?>
		
		<div>
		<table border = 1>
		<thead>
			<tr>
				<td>No</td>
				<td>Kategori</td>
				<td>Bulan</td>
				<td>Node Id</td>
				<td>Nilai rata-rata</td>
			</tr>
		</thead>

		<tbody>
		<?php $i=1; //$j=0;//echo count($hasil3d);echo json_encode($hasil3d); 
		foreach($row2 as $row): ?>
		<tr>   
			<?php //print_r($row); //print_r($row[0]);?>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['_id']['kategori']; ?></td>
			<td><?php echo $row['_id']['month']; ?></td>
			<td><?php echo $row['_id']['nodeid']; ?></td>
			<td><?php echo $row['average']; ?></td>
			<?php //if ($i>=10){break;};
					array_push($datawew2[$j],$row['average']);?>
		</tr>
		<?php 
		$i++;//$j++;
		//echo count($datawew[$j]);
		endforeach; ?>
		</tbody>
		</table>
		</div>
<?php 
//$i++;
$j++;
endforeach; ?>

</head>
<body>
<div id="container">
    
 
    <div id="body">
        <div id="chart"></div>
    </div>
	
	<div id="body">
        <div id="chart2"></div>
    </div>
	
 
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id="container2">

</div>

 
<script type="text/javascript" src="<?php echo base_url('/assets/jquery-3.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/themes/dark-green.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts-3d.js'); ?>"></script>
<script type="text/javascript">
jQuery(function(){
    new Highcharts.Chart({
        chart: {
            renderTo: 'chart',
            type: 'line',
        },
        title: {
            text: 'Perhitungan Kelembaban di kota X',
            x: -20
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: <?php echo json_encode($datebaru); ?>
        },
        yAxis: {
            title: {
                text: 'Nilai'
            }
        },
        series: [{
            name: 'Node 1 ',
            data: <?php echo json_encode($datawew[0]); ?> 
        },{
			name: 'Node 2 ',
            data: <?php echo json_encode($datawew[1]); ?> 
		},{
			name: 'Node 3	 ',
            data: <?php echo json_encode($datawew[2]); ?> 
		}
		]
    });
}); 
</script>

<script type="text/javascript">
jQuery(function(){
    new Highcharts.Chart({
        chart: {
            renderTo: 'chart2',
            type: 'line',
        },
        title: {
            text: 'Perhitungan Suhu di kota X',
            x: -20
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: <?php echo json_encode($datebaru); ?>
        },
        yAxis: {
            title: {
                text: 'Nilai'
            }
        },
        series: [{
            name: 'Node 1 ',
            data: <?php echo json_encode($datawew2[0]); ?> 
        },{
			name: 'Node 2 ',
            data: <?php echo json_encode($datawew2[1]); ?> 
		},{
			name: 'Node 3	 ',
            data: <?php echo json_encode($datawew2[2]); ?> 
		}
		]
    });
}); 
</script>



</html>


</body>
</html>