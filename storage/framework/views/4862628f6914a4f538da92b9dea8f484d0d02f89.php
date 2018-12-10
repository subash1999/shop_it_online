<!DOCTYPE html>
<html>
<head>
	<title>Button</title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app.css')); ?>">

	<div class="file btn btn-lg btn-primary">
		Upload
		<input type="file" name="file">
		
	</div>
	<style type="text/css">
	div{
		position: relative;
		overflow:hidden;	
	}
	input{
		position: relative;
		font-size: 50px;
		opacity: 0;
		right : 0;
		top : 0;
	}

</style>
<hr>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>