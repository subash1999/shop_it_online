<?php $__env->startSection('title'); ?>
Mail From Site
<?php $__env->stopSection(); ?>
<?php $__env->startSection('center'); ?>
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3"><?php echo e($data->title); ?></h3>
		<h4 class="h4">Subject : <?php echo e($data->subject); ?></h4>
		<hr>
		<h3 class="h3 text-muted">Message</h3>
		<hr>
		<div>
			<p><?php echo e($data->message); ?></p>
		</div>
	</div>
</div>
<style>
<?php echo $__env->make('mails/cart_styles_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('mails/cart_responsive_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('mails/layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>