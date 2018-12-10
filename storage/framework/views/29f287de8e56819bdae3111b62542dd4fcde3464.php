<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
<?php $__env->startSection('center-content'); ?>	
<div id="page-wrapper">
	
<!-- Contact Form -->

<div class="contact_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_form_container">
					<div class="contact_form_title" align="middle"><h2 class="h2">Send Mail From Site</h2></div>
					<?php if($success!=null): ?>
						<div class="alert alert-success">
							<?php echo e($success); ?>

						</div>
					<?php endif; ?>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="alert-danger alert">
						<li><?php echo e($error); ?></li>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<form action="<?php echo e(url('admin/send_mail')); ?>" id="contact_form" method="post">
						<?php echo csrf_field(); ?>
						<?php echo method_field('post'); ?>
						<input type="hidden" name="title" value="Message From System Admin">
						<div class="container-fluid">
							<div class="form-group m-5">
								<label for="email" >Select User : </label>
								<select name="email" class="form-control" id="" value="<?php echo e(old('email')); ?>">
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->email); ?>"><?php echo e($user->username); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							
							</div>	
							<div class="form-group m-3" ></label>
								<label for="subject" class="form-control-label">Subject :</label>
								<input name="subject" class="form-control" id="subject" value="<?php echo e(old('subject')); ?>">
							
							</div>							
						</div>
						<div class="form-group" style="width: 100%;align-content: center;">
							<textarea id="contact_form_message" style="width: 100%;" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message." class="form-control" cols="30" rows="10"><?php echo e(old('message')); ?></textarea>
						</div>
						<div class="contact_form_button">
							<button type="submit" class="btn btn-primary btn-lg">Send Message</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="panel"></div>
</div>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/sb_admin/admin_layouts/admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>