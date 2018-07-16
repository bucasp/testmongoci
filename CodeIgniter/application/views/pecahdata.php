<?php $i=1;
foreach($datebaru as $row3): ?>
<?php echo $row3; ?>

		<table border = 1>
		<tbody>
			<tr>
				<td>No</td>
				<?php foreach($monthbaru as $row): ?>
				<td><?php echo $row ?></td>
				<?php endforeach; ?>				
			</tr>
			<?php foreach($dimensikategori as $row2): ?>
			<tr>
				<td><?php echo $row2['_id']['kategori'] ?></td>
				<?php foreach($monthbaru as $row): ?>
					<td><?php echo ambilnilai($row,$row2['_id']['kategori'],$row3) ?></td>
				<?php endforeach; ?>	
			</tr>
			<?php endforeach; ?>	
				
		
		
		
		<?php 
		$i++;
		//endforeach; ?>
		</tbody>
		</table>


<br>
<?php 
//$i++;
endforeach; ?>



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