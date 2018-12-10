<?php $__env->startSection('customer_center_content'); ?>
<div class="container-fluid"> 
	<div class="row">
		<h2 class="h2 text-muted">Wallet Transistions</h2>
		<hr>
		<table class="table table-bordered">
			<?php $__currentLoopData = $wallet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td>
					<div class="form-control-label" style="font-size: large">Transistion Date</div>
					<div class="form-control-label"><?php echo e($tr->created_at); ?></div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Credit</div>
					<div class="form-control-label"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?><?php echo e($tr->getCreditInCurrentCurrency()); ?></div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Debit</div>
					<div class="form-control-label"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?><?php echo e($tr->getDebitInCurrentCurrency()); ?></div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Amount</div>
					<div class="form-control-label"><?php echo e(Auth::user()->getCurrentCurrencySymbol()); ?><?php echo e($tr->getAmountInCurrentCurrency()); ?></div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Description</div>
					<div class="form-control-label"><?php echo e($tr->description); ?></div>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
		<div><?php echo e($wallet->links()); ?></div>
	</div>
</div>
<hr>
<div class="row m-5">
	<div>
		<?php if(session("success")!=null&&session("success")!=""): ?>
			<div class="alert alert-success">
				<li><?php echo e(session('success')); ?></li>
			</div>
		<?php endif; ?>
		<?php if(count($errors->all())>0): ?>
		<div class="alert alert-danger">
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<?php endif; ?>
		<hr>
		<div align="left"><h2 class="h4">Recharge your wallet</h2></div>
		<hr>
		<form action="<?php echo e(url('customer/recharge_wallet')); ?>" method="post">
			<?php echo method_field('post'); ?>
			<?php echo csrf_field(); ?>
			<div class="row" style="margin: 5 px;">				
				<div class="form-group " style="margin: 3 px;">
					<label for="value">Recharge Code  : </label>
					<textarea type="text" name="code" class="form-control" ><?php echo e(old('code')); ?></textarea>
				</div>
			</div>
			<div>
				<input type="submit" class="btn btn-info btn-lg" value="Recharge">
			</div>
		</form>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer/layout/customer_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>