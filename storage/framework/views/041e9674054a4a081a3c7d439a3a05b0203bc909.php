<?php $__env->startSection('center_content'); ?>
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">Confirm your Order By Email</div>
            	<div class="card-body">
            		<p>A link has been sent to the email address you have entered so please confirm your validity by clicking on the link is sent to your email </p>
            		<a href="<?php echo e(url('/')); ?>"><button type="button" class="btn btn-lg btn-primary">OK</button></a>		
            	</div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_responsive.css')); ?>">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>