<?php $__env->startSection('form'); ?>

<!------ Include the above in your HEAD tag ---------->
<div class="container">
	
	<div class="row" style="background-color: white;">
		<div class="card card-primary">
			<div class="panel-body">
				
				<!-- <?php if($errors->any()): ?>
				<div class="alert alert-danger">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
				<?php endif; ?> -->
				<form method="POST" action="<?php echo e(url('/seller/register/create_account')); ?>" role="form" >
					<?php echo csrf_field(); ?>
					<?php echo method_field('post'); ?>					
					<div class="form-group">
						<img src="<?php echo e(asset('img/system/website_logo.png')); ?>" alt="Website Logo" class="mx-auto d-block img-fluid rounded" style="height: 60px">
					</div>
					<div class="form-group">
						<h4>Create Sellers account</h4>
					</div>
					<div class="form-group">
						<label class="control-label" for="username" autoComplete="username">Username</label>
						<input id="username" type="text" maxlength="100" class="form-control" name="username" required="required">
						<?php if($errors->has('username')): ?>
						<br>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->get('username'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($message); ?></li>								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<div class="form-group">
						<label class="control-label" for="email">Email</label>
						<input id="email" type="email" maxlength="100" class="form-control" name="email" required="required" autocomplete="email">
						<?php if($errors->has('email')): ?>
						<br>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->get('email'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($message); ?></li>								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>	
					<div class="form-group " id="pwd-container">
						<label class="control-label" for="password">Password</label>						
						<input id="password" type="password" minlength="6" maxlength="25" class="form-control" placeholder="at least 6 characters" length="50" name="password" required="required" autocomplete="new-password">
						
						<div id="pwstrength_viewport_progress" style="margin: 5px;"></div>
					</div>				
					<?php if($errors->has('password')): ?>
						<br>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($message); ?></li>								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>	

					<div class="form-group">
						<label class="control-label" for="password_confirmation">Password confirmation</label>
						<input id="password_confirmation" type="password" maxlength="25" class="form-control" name="password_confirmation" required="required" autocomplete="new-password">
						<?php if($errors->has('password_confirmation')): ?>
						<br>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->get('password_confirmation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($message); ?></li>								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<div class="form-group">
						<button id="signupSubmit" type="submit" class="btn btn-info btn-block">Create your account</button>
					</div>
					<p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
					<hr>
					<p>Already have an account? <a href="#">Sign in</a></p>

				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>
<script src="<?php echo e(asset('password_strength_api/pwstrength-bootstrap.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('page_assets/seller/register/css/seller_register_step_1.css')); ?>">
<script src="<?php echo e(asset('page_assets/seller/register/js/seller_register_step_1.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('seller/seller_register/seller_register_layout/seller_register_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>