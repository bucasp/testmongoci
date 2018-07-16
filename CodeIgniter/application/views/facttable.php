
<table border = 1>
<thead>
	<tr>
		<td>No</td>
		<td>Dimensi</td>
		<td>kategori</td>
		<td>tahun</td>
		<td>bulan</td>
		<td>tanggal</td>
		<td>hour</td>
		<td>Nilai</td>
		
	</tr>
</thead>

<tbody>
<?php $i=1;
foreach($hasil3d as $row): ?>
<tr>   
	<td><?php echo $i; ?></td>
    <td><?php echo $row['_id']['nodeid']; ?></td>
	<td><?php echo $row['_id']['kategori']; ?></td>
	<td><?php echo $row['_id']['year']; ?></td>
	<td><?php echo $row['_id']['month']; ?></td>
	<td><?php echo $row['_id']['day']; ?></td>
	<td><?php echo $row['_id']['hour']; ?></td>
	<td><?php echo $row['average']; ?></td>
	<?php ?>
</tr>
<?php 
$i++;
endforeach; ?>
</tbody>
</table>

<br>

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



</body>
</html>