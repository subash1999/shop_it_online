<?php $__env->startSection('center_content'); ?>
<div class="shop">
	<div class="container">
		<div class="row">
			<?php echo $__env->make('public/pages/all_products/head', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('public/pages/all_products/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('public/pages/all_products/center_shop', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
</div>

<?php echo $__env->make('public/pages/all_products/recent_review', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/shop_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/shop_responsive.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')); ?>">

<script src="<?php echo e(asset('one_tech/plugins/parallax-js-master/parallax.min.js')); ?>"></script>
<script src="<?php echo e(asset('one_tech/plugins/Isotope/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('one_tech/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')); ?>"></script>

<?php echo $__env->make('public/pages/all_products/js_shop_custom', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>