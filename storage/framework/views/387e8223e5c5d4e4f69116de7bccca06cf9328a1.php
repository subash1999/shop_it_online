<div class="col-lg-9">
	
	<!-- Shop Content -->

	<div class="shop_content">
		<div class="shop_bar clearfix">
			<div class="shop_product_count"><span><?php echo e(count($results)); ?>  </span>products found
				<?php if($old_filter['keyword']!=null && $old_filter['keyword']!=""): ?>
				&nbsp  &nbsp && Search Keyword : 
				<span><i><?php echo e($old_filter['keyword']); ?></i></span>
				<?php endif; ?>
				<?php if($old_filter['category_names']!=null && $old_filter['category_names']!=""): ?>
				&nbsp  &nbsp  && Categories : 
				<?php $__currentLoopData = $old_filter['category_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<span><i> <?php echo e($cate); ?></i></span>
				<?php if(!$loop->last): ?>
					,
				<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				<?php endif; ?>
			</div>
			<div class="shop_sorting">
				<span>Sort by:</span>
				<ul>
					<li>
						<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
						<ul>
							<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
							<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
							<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<div class="product_grid">
			<div class="product_grid_border"></div>

			<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<!-- Product Item -->
			<div class="product_item <?php echo e($result['is_new']? 'is_new':''); ?>">
				<a href="<?php echo e(url('product/'.$result['sp_id'])); ?>" tabindex="0">
					<div class="product_border"></div>
					<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="<?php echo e($result['photo']); ?>" alt=""></div>
					<div class="product_content">
						<div class="product_price"><?php echo e($curr_symb); ?> <?php echo e($result['price']); ?></div>
						<div class="product_name" title="<?php echo e($result['name']); ?>"><div><a href="<?php echo e(url('product/'.$result['sp_id'])); ?>" tabindex="0"><?php echo e($result['name']); ?></a></div></div>
					</div>
					
					<ul class="product_marks">
						
						<li class="product_mark product_new">new</li>
					</ul>
				</a>
			</div>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		

		</div>

		<!-- Shop Page Navigation -->

		<div class="shop_page_nav d-flex flex-row">
			<?php echo e($results->links()); ?>			
		</div>

	</div>

</div>