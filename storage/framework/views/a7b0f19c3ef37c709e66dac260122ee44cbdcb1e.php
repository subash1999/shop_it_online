	
	<?php $__env->startSection('customer_center_content'); ?>
	<div class="row ">
		<!-- Now the bills -->
		<div ><h3 class="h3 text-muted text-center">My Order's Bills</h3>
			<table class="table">
				<?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<tr>
					<td>
						<div class="cart_item_title">Bill Number (Id) </div>
						<div class="cart_item_text"><?php echo e($bill->bill_id); ?></div>
					</td>
					<td>
						<div class="cart_item_title">Name</div>
						<div class="cart_item_text"><?php echo e($bill->name); ?></div>
					</td>
					<td>
						<div class="cart_item_title">Billing Address</div>
						<div class="cart_item_text"><?php echo e($bill->bill_address.','.$bill->bill_city.','.$bill->bill_country); ?></div>
						<div class="cart_item_text">Phone : <?php echo e($bill->phone1); ?></div>
					</td>
					<td>
						<div class="cart_item_title">Shipping Address</div>
						<div class="cart_item_text"><?php echo e($bill->ship_address.','.$bill->ship_city.','.$bill->bill_country); ?></div>
						<div class="cart_item_text">Shipment Status : <?php echo e($bill->product_status); ?></div>
					</td>
					<td>
						<div class="cart_item_title">Total Amount</div>
						<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?>  <?php echo e($bill->getTotalAmountInCurrentCurrency()); ?></div>
					</td>
					<td>
						<div class="cart_item_title">Discount Amount</div>
						<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?> <?php echo e($bill->getDiscountAmountInCurrentCurrency()); ?></div>
					</td>
					<td>
						<div class="cart_item_title">Final Amount</div>
						<div class="cart_item_text"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?>  <?php echo e($bill->getFinalAmountInCurrentCurrency()); ?></div>	
						<div class="cart_item_text">Bill Payment Status :<?php echo e($bill->payment_status); ?></div>			
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</table>
			<div>
				<?php echo e($bills->links()); ?>

			</div>
		</div>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer/layout/customer_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>