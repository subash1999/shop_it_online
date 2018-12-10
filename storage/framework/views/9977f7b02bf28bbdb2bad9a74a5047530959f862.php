<?php $__env->startSection('center_content'); ?>


<div class="" style="margin: 10px; padding: 10px; width:100%">
	<div class="">

		<div class="row">
			<div class="h1" align="center">Products Orderd <label class="text-danger">(Only one save at a time)</label></div>
			<hr>
			<table class="table">
				<?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<tr>
					<form action="<?php echo e(url('seller/dashboard/change_payment_product_status')); ?>" method="post">
						<?php echo csrf_field(); ?>
						<?php echo method_field('post'); ?>
						<td>
							<div class="cart_item_title"><u>Bill Number (Id) </u></div>
							<div class="cart_item_text"><?php echo e($bill->bill_id); ?></div>
						</td>
						<td>
							<div class="cart_item_title"><u>Name</u></div>
							<div class="cart_item_text"><?php echo e($bill->name); ?></div>
						</td>
						<td>
							<div class="cart_item_title"><u>Billing Address</u></div>
							<div class="cart_item_text"><?php echo e($bill->bill_address.','.$bill->bill_city.','.$bill->bill_country); ?></div>
							<div class="cart_item_text"><u>Phone : </u><?php echo e($bill->phone1); ?></div>
						</td>
						<td>
							<div class="cart_item_title"><u>Shipping Address</u></div>
							<div class="cart_item_text"><?php echo e($bill->ship_address.','.$bill->ship_city.','.$bill->bill_country); ?></div>
							<div class="cart_item_text"><u>Shipment Status :</u> 
								<select name="product_status" class="form-control">
									<?php
									$confirmed = false;
									$to_be= false;
									$delivered = false;
									$canceled = false;
									if (strcasecmp($bill->product_status,'Confirmed')==0){
										$confirmed = true;
									}	
									else if(strcasecmp($bill->product_status,'To be Confirmed')==0){
										$to_be = true;
									}
									else if(strcasecmp($bill->product_status,'Canceled')==0){
										$canceled = true;
									}
									else{
										$delivered = true;
									}						
									?>
									<option value="Delivered" <?php echo e($delivered ? 'selected' : ''); ?>>Delivered
									</option>
									<option value="To be Confirmed" <?php echo e($to_be ? 'selected' : ''); ?>">To be Confirmed</option>
									<option value="Confirmed" <?php echo e($confirmed ? 'selected' : ''); ?>>Confirmed</option>
									<option value="Canceled" <?php echo e($canceled ? 'selected' : ''); ?>>Canceled</option>
								</select>
							</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Total Amount</u></div>
							<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?> <?php echo e($bill->getTotalAmountInCurrentCurrency()); ?></div>
						</td>
						<td>
							<div class="cart_item_title"><u>Discount Amount</u></div>
							<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?> <?php echo e($bill->getDiscountAmountInCurrentCurrency()); ?></div>
						</td>
						<td>
							<div class="cart_item_title"><u>Final Amount</u></div>
							<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?> <?php echo e($bill->getFinalAmountInCurrentCurrency()); ?></div>	
							<div class="cart_item_text"><u>Bill Payment Status :</u>
								<select name="payment_status" class="form-control">
									<?php
									$pending = false;
									$paid = false;
									if (strcasecmp($bill->payment_status,'paid')==0){
										$paid = true;
									}	
									else{
										$pending = true;
									}
									?>
									<option value="paid" <?php echo e($paid ? 'selected' : ''); ?>">Pending</option>
									<option value="pending" <?php echo e($pending ? 'selected' : ''); ?>>Paid</option>

								</select>

							</div>			
						</td>
						<td>
							<div class="cart_item_title"><u>Save Changes</u></div>
							<div>
								<input type="hiddden" style="display:none;" id="" name="bill_id" value="<?php echo e($bill->bill_id); ?>">
								<input type="submit" value="Save Changes" class="btn btn-warning"></div>			
							</td>
						</form>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
				</table>
				<div>
					<?php echo e($bills->links()); ?>

				</div>
			</div>
		</div>
	</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>