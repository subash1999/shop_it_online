<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
	<head>
		<title><?php echo e($admin_name); ?> : Admin Panel</title>
		<?php echo $__env->make('layouts/favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('admin/adminlte/admin_layouts/admin_dashboard_links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			<?php echo $__env->make('admin/adminlte/admin_layouts/admin_nav_bar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('admin/adminlte/admin_layouts/admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
			<?php echo $__env->yieldContent('center_content'); ?> 
		</div>
		
		<?php echo $__env->make('admin/adminlte/admin_layouts/admin_dashboard_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</body>
</html>