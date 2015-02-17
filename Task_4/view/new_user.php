<!doctype html>
<html lang="en-gb" class="no-js">

<head>
	<title>Тестовое задание 4</title>
	
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>

<body>
	<div style="width:350px; border: 1px solid #999; border-radius: 3px; padding: 5px; margin: 5px;">
		<?php
		if (isset($Errors) && !empty($Errors)){
			echo '<div class="alert alert-danger" role="alert">';
			foreach ($Errors as $error){
				echo $error . '<br>';
			}
			echo '</div>';
		}
		?>
		<form action="" method="post">
		<fieldset>
			<legend style="color:blue;font-weight:bold;">Add your phone number</legend>
			<div class="form-group">
				<label for="phone">Enter your PHONE:</label>
				<input type="text" name="phone" id="phone" class="form-control">
			</div>
			
			<div class="form-group">
				<label for="email">Enter your e-mail:</label>
				<input type="text" name="email" id="email" class="form-control">
			</div>
			
			<div class="alert alert-warning" role="alert">
				You will be able to retrieve your phone number later on using e-mail.
			</div>
			
			<button class="btn btn-primary">Submit</button>
		</fieldset>
		</form>
	</div>
</body>
