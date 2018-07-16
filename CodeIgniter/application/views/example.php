<!DOCTYPE html>
<html>
<head>

<aside class="right-side">
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>

	<div style='height:20px;'></div>  
	<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
		<style type='text/css'>
				body
				{
					font-family: Arial;
					font-size: 14px;
				}
				a {
				    color: blue;
				    text-decoration: none;
				    font-size: 14px;
				}
				a:hover
				{
					text-decoration: underline;
				}
		</style>
    <div>
		<?php echo $output; ?>
    </div>

    </aside>
</body>
</html>
