<?php echo $__env->make('layouts.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('title', 'Page Not Found'); ?>
<?php
	$message = 'Sorry, the page you are looking for could not be found.';
?>
<?php if($exception->getMessage()!=null || $exception->getMessage()!=''): ?>
	<?php
		$message = $exception->getMessage();
	?>
<?php endif; ?>

<?php $__env->startSection('message', $message); ?>

<?php echo $__env->make('errors/layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>