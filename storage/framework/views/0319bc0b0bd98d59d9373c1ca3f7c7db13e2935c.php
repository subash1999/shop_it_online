<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="shop it online">
	<meta name="author" content="Subash">
	<meta name="keyword" content="Shop It Online,Public, Home">	
	<title><?php echo e(config('app.name')); ?></title>
	
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<!-- js placed at the end of the document so the jqery can be written -->
	<script src="<?php echo e(asset('one_tech/js/jquery-3.3.1.min.js')); ?>"></script>

	<?php echo $__env->make('layouts.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('public/layout/public_links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>

	
	<?php echo $__env->make('reuseable_codes/page_loader', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="super_container">
		
		<?php echo $__env->make('public/layout/public_header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		
		<?php echo $__env->yieldContent('center_content'); ?>

		
		<?php echo $__env->make('public/layout/public_footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<?php echo $__env->make('layouts/go_to_top_btn', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<?php echo $__env->make('public/layout/public_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent('pagewise_assets'); ?>
		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>

</body>

</html>
