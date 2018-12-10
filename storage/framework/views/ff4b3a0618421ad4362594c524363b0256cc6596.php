<?php $__env->startSection('title'); ?>
OrderConfirmation
<?php $__env->stopSection(); ?>
<?php $__env->startSection('center'); ?>
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3" style="background-color: white;">Hello !</h3>
		<h5>
			Dear Cutomer, We have received an order from this email. 
			<br>
			The Receipt is below : 
		</h5>
		<div class="receipt">
			<div class="cart_section">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">		
							<div class="row">
								<?php
								// changing the bill info into the array
								$bill_info = (array) $bill_info;
								?>
								<div class="col-4 m-3">
								
								<div class="card">
									<div class="card-header"><h6 class="text-muted h6">General Information</h6></div>
									<div class="card-body">
										<ul>
										<li>
											Name : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['name']); ?></label>
										</li>
										<li>
											Email : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['email']); ?></label>

										</li>
										<li>
											Phone : <label class="form-control-label" style="text-decoration: underline;"><?php echo e($bill_info['phone']); ?></label>
										</li>
									</ul></div>
								</div>


							</div>	
							<div class="col-4 m-3">
								<div class="card">
									<div class="card-header"><h6 class="text-muted h6">Billing Address</h6></div>
									<div class="card-body">
										<li>
											Address :<label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['bill_address']); ?></label>
										</li>
										<li>
											City : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['bill_city']); ?></label>
										</li>
										<li>
											Country : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['bill_country']); ?></label>
										</li>											
									</div>
								</div>						
							</div>	
							<div class="col-4 m-3">
								<div class="card">
									<div class="card-header"><h6 class="text-muted h6">Shipping Address</h6></div>
									<div class="card-body">
										<li>
											Address : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['ship_address']); ?></label>
										</li>
										<li>
											City : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['ship_city']); ?></label>
										</li>
										<li>
											Country : <label class="form-control-label" style="text-decoration: underline;"> <?php echo e($bill_info['ship_country']); ?></label>
										</li>											
									</div>
								</div>						
							</div>									
						</div>				
						<ul class="cart_list">
							<?php $__currentLoopData = $wl_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $wl_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
							<li class="cart_item clearfix" id="cart_item_<?php echo e($key); ?>">
								<div class="cart_item_image"><a href="<?php echo e(url('product')); ?>/<?php echo e($wl_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo e(asset('storage/uploads/'.$wl_item["photo"])); ?>" alt=""></a></div>
								<div class="wl_item_info d-flex flex-md-row flex-column justify-content-between">
									<div class="cart_item_name cart_info_col">
										<div class="cart_item_title">Name</div>
										<div class="cart_item_text"><a href="<?php echo e(url('product')); ?>/<?php echo e($wl_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($wl_item["name"]); ?></a>
											<div style="font-size:small"><?php echo e($wl_item['company_name']); ?></div></div>
										</div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Option</div>
											<div class="cart_item_text"><?php echo e($wl_item["option"]); ?></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text"> <?php echo e($wl_item["qty"]); ?></label></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Unit Price</div>
											<div class="cart_item_text"><?php echo e($currency_symbol); ?> <label id="unit_price_<?php echo e($key); ?>"> <?php echo e($wl_item["unit_price"]); ?></label></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Total Price</div>
											<div class="cart_item_text"><?php echo e($currency_symbol); ?> <label id="unit_price_<?php echo e($key); ?>"> <?php echo e($wl_item["total_price"]); ?></label></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Payable Amount</div>
											<div class="cart_item_text"><?php echo e($currency_symbol); ?> <label id="unit_price_<?php echo e($key); ?>"> <?php echo e($wl_item["payable_amount"]); ?></label></div>
										</div>
									</div>
								</li>
								<hr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>

							<!-- Order Total -->
							<div class="order_total">
								<div class="order_total_content text-md-right">
									<div class="order_total_title">Order Total:</div>
									<div class="order_total_amount"><?php echo e($currency_symbol); ?> <?php echo e($bill_info['total_price']); ?></div>
									<div class="order_total_title">Payable Amount:</div>
									<div class="order_total_amount"><?php echo e($currency_symbol); ?> <?php echo e($bill_info['payable_amount']); ?></div>

								</div>
							</div>
							<div class="cart_buttons">
								<div>
									<p>If It was You Please Click the button and confirm the your order. <br>
										Otherwise Please Ignore this mail
									</p>
									<a href="<?php echo e($url); ?>"><button class="button btn-lg btn-primary">Confirm You Order</button></a>
									<p>If You can't click the button copy and paste the link below in url</p>
									<div class="row">
										<div class="col-12 text-truncate">
											<a style="color:blue;" id="link" href="<?php echo e($url); ?>" id="url"><?php echo e($url); ?></a>
										</div>
									</div>


								</div>
							</div>


						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>
<style>
<?php echo $__env->make('mails/cart_styles_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('mails/cart_responsive_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('mails/layouts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>