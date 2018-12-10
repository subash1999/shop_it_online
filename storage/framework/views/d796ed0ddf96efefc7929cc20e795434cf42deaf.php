<?php $__env->startSection('center_content'); ?>
<?php
	// dd($errors);
?>
<form action="<?php echo e(url('checkout/checkout_info')); ?>" method="GET">
	<?php echo method_field('GET'); ?>
	<?php echo csrf_field(); ?>
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Checkout <label style="font-size: small;">(Place Your Order)</label></div>
						<div class="cart_title h4">Total Items : <label><?php echo e($total_items); ?></label></div>
						<div class="cart_items">
							<ul class="cart_list">
								<?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
								<?php if(isset($cart_item["sp_id"])): ?>
								<input type="hidden" name="items[<?php echo e($key); ?>][sp_id]" value="<?php echo e($cart_item["sp_id"]); ?>">								
								<?php endif; ?>
								<?php if(isset($cart_item["qty"])): ?>
								<input type="hidden" name="items[<?php echo e($key); ?>][qty]" value="<?php echo e($cart_item["qty"]); ?>">								
								<?php endif; ?>
								<?php if(array_key_exists("spor_id",$cart_item)): ?>
								<input type="hidden" name="items[<?php echo e($key); ?>][spor_id]" value="<?php echo e($cart_item["spor_id"]); ?>">								
								<?php endif; ?>	

								<li class="cart_item clearfix" id="cart_item_<?php echo e($key); ?>">
									<div class="cart_item_image"><a href="<?php echo e(url('product')); ?>/<?php echo e($cart_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo e(asset('storage/uploads/'.$cart_item["photo"])); ?>" alt=""></a></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">					
											<div class="cart_item_text">Name : <a href="<?php echo e(url('product')); ?>/<?php echo e($cart_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer" class="hover_underline" ><?php echo e($cart_item["name"]); ?></a>
												<br>
												<?php if(isset($cart_item["seller_company"])): ?>
												<a href="javascript:void(0)"  target="_blank" rel="noopener noreferrer" style="font-size: x-small;color:black;" class="hover_underline"><?php echo e($cart_item["seller_company"]); ?></a>
												<?php endif; ?>
												<style>
												.hover_underline:hover{
													text-decoration: underline;
													color : blue;
												}
											</style>
											<?php if($cart_item["option"]!=''): ?>
											<div class="">Option</div>
											<div class="cart_option_text" ><?php echo e($cart_item["option"]); ?></div>
											<?php endif; ?>

										</div>

									</div>										
									<div class="cart_item_quantity cart_info_col">
										<div class="cart_item_text">Quantity : <?php echo e($cart_item['qty']); ?></div>
										<div class="cart_item_text">

											<div class="">Unit Price : 
												<?php echo e($cart_item['currency_symbol']); ?> <label id="unit_price_<?php echo e($key); ?>"> <?php echo e($cart_item["unit_price"]); ?></label>
											</div>
										</div>
									</div>
									<div class="cart_item_price cart_info_col">

									</div>
									<div class="cart_item_total cart_info_col">
										<div class="cart_item_title">Total</div>
										<div class="cart_item_text"><?php echo e($cart_item['currency_symbol']); ?> <label id="total_<?php echo e($key); ?>"> <?php echo e($cart_item["total_price"]); ?></label></div>
									</div>										
								</div>
							</li>
							<hr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
					<div>

					</div>



				</div>

			</div>
			<div class="col-lg-3 mt-5 ">
				<div class="card text-white bg-info mb-3 mt-5">
					<div class="card-header card-warning h4">Please Confirm Your Order</div>
					<div class="card-body">
						<div class="row m-2">
							<div class="row m-2">Total Items : <?php echo e($total_items); ?></div>
							<div class="m-2">Place Order Of Total:
								<label id="grand_total"><?php echo e($currency_symbol); ?>  <?php echo e($grand_total); ?></label>
							</div>
							
						</div>
						
						<?php if(auth()->guard()->check()): ?>
						<hr>
						<div class="row h6">Discount Coupon : </div>
						<div style="font-size : x-small;">(Discount Coupon can only pay  up to 20% of total sales, once used it cannot be again used so use wisely)</div>
						<div style="font-size : x-small;">(If you have any)</div>
						<div class="row"><input class="form-control" id="discount_coupon" name="discount_coupon" type="text" width="100%" <?php echo e(old('discount_coupon')); ?>></div>
						<?php if($errors->has('discount_coupon') || $errors->has('discount_coupon_valid')): ?>
						<div class="alert alert-danger mt-2" role="alert">
							
								<?php if($errors->first('discount_coupon_valid')!= $errors->first('discount_coupon')): ?>
								<ul>
									<li><strong><?php echo e($errors->first('discount_coupon_valid')); ?></strong></li>
									<li><strong><?php echo e($errors->first('discount_coupon')); ?></strong></li>
								</ul>
								<?php else: ?>
								<ul>
									<li><strong><?php echo e($errors->first('discount_coupon_valid')); ?></strong></li>
									
								</ul>
								<?php endif; ?>
								
						</div>
						<?php endif; ?>					
						<?php endif; ?>					
						<div class="row">
							<div class="cart_buttons mr-3">NEXT STEP : 
					<input type="submit" style="cursor: pointer;" class="btn btn btn-warning" value="Next: Your Information">
				</div>				
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>

<script src="<?php echo e(asset('one_tech/js/cart_custom.js')); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_responsive.css')); ?>">
<?php if($errors->has('not_an_array')||$errors->has('sp_not_set')): ?>
<script>
	$(document).ready(function() {
		bootbox.alert({
			title: "Error in the data being passed, Redirecting to cart in 5 seconds",
			message:  "Please go back to cart and again proceed to checkout <br> Error Message : Data is corrupted",
			size : 'large',
		});
		setTimeout(function () {
       window.location.href = "<?php echo e(url('cart')); ?>"; //will redirect to your blog page (an ex: blog.html)
    }, 5000); //will call the function after 2 secs.
	});

</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>