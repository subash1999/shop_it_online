<!DOCTYPE html>
<html>
<head>
	<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
    
	<title>Test </title>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app.css')); ?>">
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
</head>
<body>
<form action="" method="POST" role="form" id="form">
	<?php echo method_field('PUT'); ?>
	<?php echo csrf_field(); ?>
	<div class="form-group">
		<label class="form-control-label" for="value">Input value : </label>
		<input type="text" name="value" class="form-control">
	</div>
	<input type="button" id="submit_btn" onclick="myfunction()" name="submit" value="Submit">
</form>
</body>
<script >
 window.url = "<?php echo e(URL::to("admin/users/user_types/1")); ?>";	
</script>

<script src="<?php echo e(asset('test.js')); ?>"></script>
</html>