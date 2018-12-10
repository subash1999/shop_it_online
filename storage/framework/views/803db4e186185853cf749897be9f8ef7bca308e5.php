<html>
<head>
	<title><?php echo $__env->yieldContent('title'); ?>NoReply</title>
	
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</head>
<body>
	<style>
		a.website_logo_link{
			color:inherit;

		}
		a.website_logo_link:hover{
			text-decoration: none;
			
		}
	</style>
		<nav class="navbar navbar-expand-md navbar-light navbar-laravel" align="center"><img class="img-responsive mr-2" src="<?php echo e(asset('img/system/website_logo_2.png')); ?>" width="100"><div class="nav-item float-right" ><a class="website_logo_link" href="<?php echo e(url('/')); ?>"><h1 class="h1" align="center"><?php echo e(config('app.name')); ?></h1></a></div></nav>
		<div class="m-5 "width="50%">
			<?php echo $__env->yieldContent('center'); ?>
		</div>
	<style>
	.footer {
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;		
		text-align: center;
	}
</style>

<div class="alert-info mt-3" align="center">
	<div >Created By : <?php echo e(config('app.name')); ?></div>
	<div >Website : <a class="color-" href="<?php echo e(url('/')); ?>"><?php echo e(url('/')); ?></a></div>
</div>

</body>


<style>
	<?php echo $__env->make('mails/app_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
</style>
</html>