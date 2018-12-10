<?php $__env->startSection('customer_center_content'); ?>
<div class="container-fluid"> 
	<div class="row">
		<div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
			<div class="card-header">My Profile <button class="float-right" class=" btn btn-info">Edit</button></div>
			<div class="card-body">
				<h5 class="card-title">Name : <?php echo e(Auth::user()->getFullName()); ?></h5>
				<p class="card-text">
					<ul type="none">
						<li>Gedner : <?php echo e(Auth::user()->getGender()); ?></li>
						
					</ul></p>
				</div>
			</div>
			<div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
				<div class="card-header">My Contact <button class="float-right" class=" btn btn-info">Edit</button></div>
				<div class="card-body">
					<h5 class="card-title">Username : <?php echo e(Auth::user()->username); ?></h5>
					<p class="card-text">
						<ul type="none">
							<li>Email : <?php echo e(Auth::user()->email); ?></li>
							<li>Phone : <?php echo e(Auth::user()->getPhone()); ?></li>
							<li>Address : <?php echo e(Auth::user()->getAddress()); ?></li>
							<li>City : <?php echo e(Auth::user()->getCity()); ?></li>
							<li>Country : <?php echo e(Auth::user()->getCountry()); ?></li>
						</ul></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div ><h3 class="h3 text-muted text-center">Discount Coupons</h3>
			</div>
			<div class="cart_items" width="100%">
				<ul class="cart_list">
					<?php
						// dd(Auth::user()->getDiscountCoupons());
					?>
					<?php $__currentLoopData = $dcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li class="cart_item clearfix">
						<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
							<div class="cart_item_name cart_info_col">
								<div class="cart_item_title">Coupon Number </div>
								<div class="cart_item_text"><?php echo e($dc->dc_id); ?></div>
							</div>
							<div class="cart_item_quantity cart_info_col">
								<div class="cart_item_title">Valid From</div>
								<div class="cart_item_text"><?php echo e($dc->from); ?></div>
							</div>
							<div class="cart_item_price cart_info_col">
								<div class="cart_item_title">Valid To</div>
								<div class="cart_item_text"><?php echo e($dc->to); ?></div>
							</div>
							<div class="cart_item_total cart_info_col">
								<div class="cart_item_title">Amount</div>
								<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?> <?php echo e(Auth::user()->getDCAmountInCurrenctCurrency($dc->dc_id)); ?></div>
							</div>
						</div>
					</li>	
					<hr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div>
						<?php echo e($dcs->links()); ?>

					</div>
					
				</ul>
			</div>
		</div>
		<?php $__env->stopSection(); ?>
		<?php $__env->startSection('customer_pagewise_assets'); ?>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer/layout/customer_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>