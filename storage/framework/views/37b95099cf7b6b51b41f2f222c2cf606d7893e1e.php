<?php $__env->startSection('title', 'Page Not Found'); ?>
<?php
	$message = 'Sorry, the page you are looking for could not be found.';
?>
<?php if($exception->getMessage()!=null): ?>
	<?php
		$message = $exception->getMessage();
	?>
<?php endif; ?>

<?php $__env->startSection('message', $message); ?>

<?php echo $__env->make('errors::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>