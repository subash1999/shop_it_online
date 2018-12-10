<?php $__env->startSection('title'); ?>
OrderConfirmation
<?php $__env->stopSection(); ?>
<?php $__env->startSection('center'); ?>
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3">Someone Wants to contact you</h3>
		<div class="row">
			<div class="card">
			<div class="card-header">General Info</div>
			<div class="card-body">
				<div class="row">Name : <?php echo e($data->name); ?></div>
				<div class="row">Email : <?php echo e($data->email); ?></div>
				<div class="row">Phone Number : <?php echo e($data->phone); ?></div>
			</div>
		</div>
		</div>
		<hr>
		<h3 class="h3 text-muted">Message</h3>
		<hr>
		<div>
			<p><?php echo e($data->message); ?></p>
		</div>
	</div>
</div>
<style>
<?php echo $__env->make('mails/assets/cart_styles_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('mails/assets/cart_responsive_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('mails/layouts/layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>