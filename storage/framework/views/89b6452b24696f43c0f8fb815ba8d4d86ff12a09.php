
<?php if($rec_view!=null): ?>
<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Recently Viewed</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">


                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">

                     <?php $__currentLoopData = $rec_view; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <!-- Recently Viewed Item -->
                     <div class="owl-item">
                        <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="viewed_image"><img src="<?php echo e($prod["photo"]); ?>" alt=""></div>
                            <div class="viewed_content text-center">
                                <div class="viewed_price"><?php echo e($curr_symb); ?> <?php echo e($prod['price']); ?></div>
                                <div class="viewed_name"><a href="<?php echo e(url('product/'. $prod['sp_id'])); ?>"  target="_blank" rel="noopener noreferrer"><?php echo e($prod['name']); ?></a></div>
                            </div>
                            <ul class="item_marks">
                                <?php if(false): ?>
                                <li class="item_mark item_discount">-25%</li>
                                <?php endif; ?>

                                <?php if($prod['new']): ?>
                                <li class="item_mark d-block item_new">new</li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endif; ?><!-- Recently viewed  end -->