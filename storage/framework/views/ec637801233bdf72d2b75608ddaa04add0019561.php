<?php $__env->startSection('form'); ?>
<h1 class="font-italic ">Complete Your Registration</h1>

<form id="regForm" action="<?php echo e(asset('seller/register/step2')); ?>" enctype="multipart/form-data" method="post">
	<?php echo csrf_field(); ?>
	<?php echo method_field('post'); ?>	
	<?php if($errors->any()): ?>
	<div id="errorList">
		<div class="alert-danger" >
			<div class="alert-heading"><u><h4>Lists of Errors on Form</h4></u></div>
			<div class="" width="50%"  >
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
	</div>
	<?php endif; ?> 
	
	<div style="text-align:center;margin-top:10px;">
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
	</div>
	<!-- One "tab" for each step in the form: -->
	<div class="tab">
		<h2 style="text-align: center;">Seller Information</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>			
		</div>
		<?php echo $__env->make('seller/seller_register/seller_register_pages/seller_information_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="tab">
		<h2 style="text-align: center;">Company Information</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Company Info</div>			
		</div>
		<?php echo $__env->make('seller/seller_register/seller_register_pages/company_information_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="tab">
		<h2 style="text-align: center;">Contact Information</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Company Info</div>
			<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Contact Info</div>			
		</div>
		<?php echo $__env->make('seller/seller_register/seller_register_pages/contact_information_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div class="tab">
		<h2 style="text-align: center;">Information Verifcation</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Company Info</div>
			<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Contact Info</div>
			<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Info Verif..</div>
		</div>
		<?php echo $__env->make('seller/seller_register/seller_register_pages/information_verification_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<div style="overflow:auto;">
		<div style="float:right;">
			<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
			<button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn-info">Next</button>
		</div>
	</div>
	<!-- Circles which indicates the steps of the form: -->

</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('page_assets/seller/register/css/seller_register_step_2.css')); ?>">
<?php echo $__env->make('seller/seller_register/seller_register_pages/js_seller_register_step_2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('seller/seller_register/seller_register_layout/seller_register_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>