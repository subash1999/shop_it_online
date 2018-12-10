<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="sellers dashboard in shop it online">
	<meta name="author" content="Subash">
	<meta name="keyword" content="Shop It Online,Seller, Dashboard">
	<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
	<title><?php echo e(Auth::user()->username); ?> : Seller Dashboard</title>
	<!-- js placed at the end of the document so the js can be written -->
	<script src="<?php echo e(asset('page_assets/seller/dashio/lib/jquery/jquery.min.js')); ?>"></script>
	<?php echo $__env->make('layouts.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>

<?php echo $__env->make('reuseable_codes/page_loader', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<section id="container">
		
		
		<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		
		<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<section id="main-content">
			<section class="wrapper">
				<div class="row">
					
					<?php echo $__env->yieldContent('center_content'); ?>
				</div>
			</section>
		</section>
		
		<?php echo $__env->make("layouts.go_to_top_btn", \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</section>
	<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent('pagewise_assets'); ?>
	<?php echo $__env->yieldContent('formwise_asset'); ?>
</body>

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
</script>
</html>
