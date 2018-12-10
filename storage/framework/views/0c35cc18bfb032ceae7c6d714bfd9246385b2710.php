
<div class="col-lg-3">

	<!-- Shop Sidebar -->
	<div class="shop_sidebar">
		<form action="<?php echo e(url('all_products')); ?>" method="get">
			<?php echo method_field('get'); ?>
			
			<div class="sidebar_section filter_by_section">
				<div class="sidebar_title">Filter By</div>
				<?php if($selected_seller!=null): ?>
				<div class="sidebar_subtitle">
					<img src="<?php echo e(asset('one_tech/images/search.png')); ?>" style="background-color: orange;" alt="" class="mr-2">
					<input type="text" placeholder="Search in the Shop" style="border:0px;border-bottom: bold;" name="shop_keyword" value=<?php echo e($old_filter['shop_keyword']); ?>>
				</div>		
				<?php endif; ?>				
				<div class="sidebar_subtitle">Categories</div>
				<ul class="sidebar_categories text-muted" >
					<?php $__currentLoopData = $cate_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><div class="form-inline"> <input style="transform: scale(1.3);" type="checkbox" value="<?php echo e($cate['cate_id']); ?>" id="cate_<?php echo e($cate['cate_id']); ?>" name="category[<?php echo e($key); ?>]" class="form-control m-2 cate_input" ><?php echo e($cate['cate_name']); ?></div></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				
				</ul>
				<div class="sidebar_subtitle">Price (<?php echo e($curr_symb); ?>)</div>
				<div class="filter_price">
					<div><div class="form-inline m-3"><label for="min" class="form-control-label">Min : </label><input type="number" step="0.001" class="form-control" name="min" id="min" value="<?php echo e($old_filter['min']); ?>"></div>
					<div class="form-inline m-3"><label for="max" class="form-control-label">Max : </label><input type="number" step="0.001" class="form-control" name="max" id="max" value="<?php echo e($old_filter['max']); ?>"></div>
				</div>				
			</div>
			<div class="sidebar_subtitle">Sellers</div>
			<div class="form-group">
				<select name="seller_id" id="seller_id" class="form-control bootstrap-select m-3 not_width_change">
					<option value="" selected>-- Select Seller --</option>
					<?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($seller->seller_id); ?>"><?php echo e($seller->company_name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<?php if($selected_seller!=null): ?>
				<script>
					$(document).ready(function() {
						$("#seller_id").val(<?php echo e($selected_seller->seller_id); ?>);
					});
				</script>
				<?php endif; ?>
				<?php if($old_filter['category']!=null): ?>
				<?php $__currentLoopData = $old_filter['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<script>
					$(document).ready(function() {
						$('#cate_<?php echo e($cate_id); ?>').prop('checked',true);
					});
				</script>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
				
				<style>
				.bootstrap_select{
					color:black;
					display: inherit; 
					border: 1px solid #ced4da; 
					/*width: auto; */
					margin-left: auto; 
					-webkit-appearance: inline; 
					-moz-appearance: button;
					border-bottom: auto; 
					color: black; 
					-webkit-transition: all .4s ease-in-out; 
					transition: all .4s ease-in-out; 

				}
			</style>
		</div>
	</div>
	<div class="sidebar_section">
		<div class="sidebar_title"><input type="submit" class="btn btn-lg btn-info m-3" value="Apply Filter"></div>
		<div></div>
	</div>
</form>		

</div>

</div>
