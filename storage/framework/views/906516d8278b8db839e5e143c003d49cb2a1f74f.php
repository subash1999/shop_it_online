<?php $__env->startSection('center_content'); ?>
<div class="contact_info">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

					<!-- Contact Item -->
					<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
						<div class="contact_info_image"><img src="<?php echo e(asset('one_tech/images/contact_1.png')); ?>" alt=""></div>
						<div class="contact_info_content">
							<div class="contact_info_title">Phone</div>
							<div class="contact_info_text">+977 9846055581</div>
						</div>
					</div>

					<!-- Contact Item -->
					<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
						<div class="contact_info_image"><img src="<?php echo e(asset('one_tech/images/contact_2.png')); ?>" alt=""></div>
						<div class="contact_info_content">
							<div class="contact_info_title">Email</div>
							<div class="contact_info_text">subash.niroula4455@gmail.com</div>
						</div>
					</div>

					<!-- Contact Item -->
					<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
						<div class="contact_info_image"><img src="<?php echo e(asset('one_tech/images/contact_3.png')); ?>" alt=""></div>
						<div class="contact_info_content">
							<div class="contact_info_title">Address</div>
							<div class="contact_info_text">Changunarayan, Bhaktapur</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Contact Form -->

<div class="contact_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_form_container">
					<div class="contact_form_title">Get in Touch</div>
					<?php if(session('success')!=null): ?>
						<div class="alert alert-success">
							<?php echo e(session('success')); ?>

						</div>
					<?php endif; ?>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="alert-danger alert">
						<li><?php echo e($error); ?></li>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<form action="<?php echo e(url('send_contact_message')); ?>" id="contact_form" method="post">
						<?php echo csrf_field(); ?>
						<?php echo method_field('post'); ?>
						<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
							<input type="text" id="contact_form_name" name="name" class="contact_form_name input_field" placeholder="Your name" required="required" data-error="Name is required." value="<?php echo e(old('name')); ?>">
							<input type="text" id="contact_form_email" name="email" class="contact_form_email input_field" placeholder="Your email" required="required" data-error="Email is required." value="<?php echo e(old('email')); ?>">
							<input type="text" id="contact_form_phone" name="phone" class="contact_form_phone input_field" placeholder="Your phone number" value="<?php echo e(old('phone')); ?>">
						</div>
						<div class="contact_form_text">
							<textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."><?php echo e(old('message')); ?></textarea>
						</div>
						<div class="contact_form_button">
							<button type="submit" class="button contact_submit_button">Send Message</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="panel"></div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>

<script src="<?php echo e(asset('one_tech/js/contact_custom.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/contact_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('styles/contact_responsive.css')); ?>">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>