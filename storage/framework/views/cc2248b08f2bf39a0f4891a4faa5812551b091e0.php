<?php $__env->startSection('center_content'); ?>
<!-- Recently Viewed -->
<div class="banner">
    <div class="banner_background" style="background-image:url(<?php echo e(asset('one_tech/images/banner_background.jpg')); ?>)"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image"><img src="<?php echo e($banner['photo']); ?>" alt=""></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text"><?php echo e($banner['category']); ?></h1>
                    <div class="banner_price"><?php echo e($curr_symb); ?> <?php echo e($banner['price']); ?></div>
                    <div class="banner_product_name"><?php echo e($banner['name']); ?></div>
                    <div class="button banner_button"><a href="<?php echo e(url('product/'. $banner['sp_id'])); ?>"  target="_blank" rel="noopener noreferrer">Shop Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($deals!=null): ?>               
<div class="deals_featured mt-3">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                <!-- Deals -->
                <div class="deals">
                    <div class="deals_title">Our Best Selling Products</div>
                    <div class="deals_slider_container">                        

                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                

                            <!-- Deals Item -->
                            <div class="owl-item deals_item">
                                <div class="deals_image"><img src="<?php echo e($deal['photo']); ?>" alt=""></div>
                                <div class="deals_content">
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_category"><a href="#"  target="_blank" rel="noopener noreferrer"><?php echo e($deal['category']); ?></a></div>                                        
                                    </div>
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_name"><a href="<?php echo e(url('product/'.$deal['sp_id'])); ?>"  target="_blank" rel="noopener noreferrer"><?php echo e($deal['name']); ?></a></div>
                                        <div class="deals_item_price ml-auto"><?php echo e($curr_symb); ?> <?php echo e($deal['price']); ?></div>
                                    </div>
                                    <div class="available">
                                        <div class="available_line d-flex flex-row justify-content-start">
                                            <div class="available_title">Available: <span><?php echo e($deal['available']); ?></span></div>
                                            <div class="sold_title ml-auto">Already sold: <span><?php echo e($deal['sold']); ?></span></div>
                                        </div>
                                        <?php
                                        $sum = $deal['available']+$deal['sold'];
                                        ?>
                                        <?php if($sum>0): ?>                    
                                        <div class="available_bar"><span style="width:<?php echo e($deal['sold']/($deal['sold']+$deal['available'])*100); ?>%"></span></div>
                                        <?php endif; ?>
                                        
                                    </div>                                    
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                    </div>
                </div>

                <!-- Deals -->
                <div class="deals">
                    <div class="deals_title">Recommendations</div>
                    <div class="deals_slider_container">                        

                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            <?php $__currentLoopData = $deals2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                

                            <!-- Deals Item -->
                            <div class="owl-item deals_item">
                                <div class="deals_image"><img src="<?php echo e($deal2['photo']); ?>" alt=""></div>
                                <div class="deals_content">
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_category"><a href="#"  target="_blank" rel="noopener noreferrer"><?php echo e($deal2['category']); ?></a></div>                                        
                                    </div>
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_name"><a href="<?php echo e(url('product/'.$deal2['sp_id'])); ?>"  target="_blank" rel="noopener noreferrer"><?php echo e($deal2['name']); ?></a></div>
                                        <div class="deals_item_price ml-auto"><?php echo e($curr_symb); ?> <?php echo e($deal2['price']); ?></div>
                                    </div>
                                    <div class="available">
                                        <div class="available_line d-flex flex-row justify-content-start">
                                            <div class="available_title">Available: <span><?php echo e($deal2['available']); ?></span></div>
                                            <div class="sold_title ml-auto">Already sold: <span><?php echo e($deal2['sold']); ?></span></div>
                                        </div>
                                        <?php
                                        $sum = $deal2['available']+$deal2['sold'];
                                        ?>
                                        <?php if($sum>0): ?>                    
                                        <div class="available_bar"><span style="width:<?php echo e($deal2['sold']/($deal2['sold']+$deal2['available'])*100); ?>%"></span></div>
                                        <?php endif; ?>
                                        
                                    </div>                                    
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                    </div>
                </div>

                

            </div>
        </div>
        <?php endif; ?>


    </div>
</div>
</div>
</div>

<div class="banner_2 mt-4">
    <div class="banner_2_background" style="background-image:url(<?php echo e(asset('one_tech/images/banner_2_background.jpg')); ?>)"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category"><?php echo e($banner2['category']); ?></div>
                                    <div class="banner_2_title"><?php echo e($banner2['name']); ?></div>
                                    <div class="button banner_2_button"><a href="<?php echo e(url('product/'.$banner2['sp_id'])); ?>">Explore</a></div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="<?php echo e($banner2['photo']); ?>" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>

        </div>
    </div>
</div>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>
<?php echo $__env->make('public/pages/home/home_assets', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>