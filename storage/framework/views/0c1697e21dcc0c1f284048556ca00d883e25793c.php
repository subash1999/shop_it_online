<!DOCTYPE html>
<html>
<head>
	<title>Seller Registration :<?php echo e(config('app.name', 'SIO')); ?></title>
	<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
	<?php echo $__env->make('layouts.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('seller/seller_register/seller_register_layout/seller_register_links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
</head>
<body>
	<?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div id="seller_step1_form">
	<?php echo $__env->yieldContent('form'); ?>
	</div>
</body>
<?php echo $__env->make('seller/seller_register/seller_register_layout/seller_register_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('pagewise_assets'); ?>
<script >
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
</script>
</html>
