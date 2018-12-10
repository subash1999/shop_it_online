<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
<?php $__env->startSection('center-content'); ?>	
<div id="page-wrapper">
	<div class="container-fluid">
		<hr>
		<div class="row " style="margin: 5 px;">			
			<div align="center"><h2 class="h2">Wallet Recharges</h2></div>
			<hr>
			<div>
				<?php if(count($errors->all())>0): ?>
					<div class="alert alert-danger">
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php endif; ?>
				<div align="left"><h2 class="h4">Add a Recharge Code</h2></div>
				<form action="<?php echo e(url('admin/wallet_recharge/add_recharge')); ?>" method="post">
					<?php echo method_field('post'); ?>
					<?php echo csrf_field(); ?>
					<div class="row" style="margin: 5 px;">
						<div class="form-group " style="margin: 3 px;">
							<label for="curr">Currency : </label>
							<select  name="curr_id" id="curr_id"  class="form-control">
								<option value="" disabled selected >-- Select Currency -- </option>
								<?php $__currentLoopData = $curr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($c->curr_id); ?>"><?php echo e($c->symbol); ?> <?php echo e($c->country); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</select>
						</div>
						<div class="form-group " style="margin: 3 px;">
							<label for="value">Value (Amount) : </label>
							<input type="text" name="value" class="form-control" value="<?php echo e(old('value')); ?>">
						</div>
					</div>
					<div>
						<input type="submit" class="btn btn-success btn-lg" value="Add">
					</div>
				</form>
			</div>
			<hr>
			<div align="center"><h2 class="h2">Available Recharges</h2></div>
			<hr>
			<table class="table">
				<?php $__currentLoopData = $rcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<div class="form-control-label text-muted h6" style="font-size:large; ">RCH ID</div>
						<div class="form-control-label  " style="font-size: large;"><?php echo e($rch->wallet_recharge_id); ?></div>
					</td>
					<td>
						<div class="form-control-label text-muted h6" style="font-size:large; ">Value</div>
						<div class="form-control-label  " style="font-size: large;"><?php echo e($curr_symb); ?> <?php echo e($rch->value); ?></div>
					</td>
					<td>
						<div class="form-control-label text-muted h6" style="font-size:large;" >Code</div>
						<textarea class="form-control-label " style="font-size: large;" id="$rch->wallet_recharge_id" disabled><?php echo e($rch->code); ?></textarea>
					</td>
					<td>
						<div style="font-size: x-large;" style="display: none;"><i style="display: none;" class="far fa-clipboard" onclick="clipboard(<?php echo e($rch->wallet_recharge_id); ?>)"></i></div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
			<div><?php echo e($rcs->links()); ?></div>

		</div>
	</div>
</div>	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/sb_admin/admin_layouts/admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>