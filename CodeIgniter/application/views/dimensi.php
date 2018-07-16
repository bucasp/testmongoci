
<table border = 1>
<thead>
	<tr>
		<td>No</td>
		<td>Dimensi</td>
		
	</tr>
</thead>

<tbody>
<?php $i=1;
foreach($dimensinode as $row): ?>
<tr>   
	<td><?php echo $i; ?></td>
    <td><?php echo $row['_id']['nodeid']; ?></td>
	<?php if ($i>=10){break;};?>
</tr>
<?php 
$i++;
endforeach; ?>
</tbody>
</table>

<br>

<table border = 1>
<thead>
	<tr>
		<td>No</td>
		<td>Dimensi</td>
		
	</tr>
</thead>

<tbody>
<?php $i=1;
foreach($dimensikategori as $row): ?>
<tr>   
	<td><?php echo $i; ?></td>
    <td><?php echo $row['_id']['kategori']; ?></td>
	<?php if ($i>=10){break;};?>
</tr>
<?php 
$i++;
endforeach; ?>
</tbody>
</table>

<br>

<table border = 1>
<thead>
	<tr>
		<td>No</td>
		<td>Dimensi</td>
		
	</tr>
</thead>

<tbody>
<?php $i=1;
foreach($datebaru as $row): ?>
<tr>   
	<td><?php echo $i; ?></td>
    <td><?php echo $row; ?></td>
	<?php ?>
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



</body>
</html>