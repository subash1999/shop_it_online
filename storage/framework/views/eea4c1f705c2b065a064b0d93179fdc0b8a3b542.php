<?php $__env->startSection('center_content'); ?>
<div id="center_division">
	<?php echo $__env->make('admin/adminlte/admin_pages/dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>    		
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/adminlte/admin_layouts/admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>