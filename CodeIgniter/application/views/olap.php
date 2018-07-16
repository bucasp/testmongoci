
<table border = 1>
<thead>
	<tr>
		<td>No</td>
		<td>Kategori</td>
		<td>Tanggal</td>
		<td>Node Id</td>
		<td>Nilai rata-rata</td>
	</tr>
</thead>

<tbody>
<?php $i=1;echo json_encode($hasil3d);
foreach($hasil3d as $row): ?>
<tr>   
	<td><?php echo $i; ?></td>
    <td><?php echo $row['_id']['kategori']; ?></td>
    <td><?php echo $row['_id']['tanggalan']; ?></td>
    <td><?php echo $row['_id']['nodeid']; ?></td>
    <td><?php echo $row['average']; ?></td>
	<?php if ($i>=10){break;};?>
</tr>
<?php 
$i++;
endforeach; ?>
</tbody>
</table>


</head>
<body>
<div id="container">
    
 
    <div id="body">
        <div id="chart"></div>
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
            text: 'Perhitungan WSN di kota X',
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
            name: 'Humidity ',
            data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111] 
        },{
			name: 'Temperature ',
            data: [55, 5948, 8105, 11248, 8989, 11816, 18274, 18111] 
		}
		]
    });
}); 
</script>


</body>
</html>