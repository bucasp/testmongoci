



<center><h1>Filtering</h1>
<?php echo form_open('olap/filter'); ?>
<table>
  <tr><td>Tanggal Start</td><td><input type="text" id="tanggal_start" class="datepicker" name="tanggal1"></td></tr>
  <tr><td>Tanggal End</td><td><input type="text" id="tanggal_end" class="datepicker" name="tanggal2"></td></tr>
  <tr><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>
</table>
</form>
</center>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bootstrap Datepicker di Codeigniter</title>
</head>

<!-- file bootstrap css yang digunakan-->

<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet">


 <!-- jQuery Version 1.11.0 -->
 <script src="<?php echo base_url() ?>assets/assets/jquery-1.11.0.js"></script>


<!--file include Bootstrap js dan datepickerbootstrap.js-->

<script src="<?php echo base_url(); ?>assets/assets/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui.min.js"charset="UTF-8"></script>

<!-- Fungsi datepickier yang digunakan -->
<script type="text/javascript">
 $('#tanggal_start').datepicker({
        dateFormat: "yy-mm-dd",
		dateonly:true
    });
	
	$('#tanggal_end').datepicker({
        dateFormat: "yy-mm-dd",
		dateonly:true
    });
</script> 