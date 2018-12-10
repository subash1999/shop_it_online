<!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
<!--sidebar start--> 
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <p class="centered"><a href="profile.html"><img src="<?php echo e(Auth::user()->getPhotoUrl()); ?>" class="img-circle" width="80"></a></p>
      <h5 class="centered"><?php echo e(Auth::user()->username); ?></h5>
      <li class="mt no-sub-menu">
        <a class="" href="<?php echo e(url('seller/dashboard')); ?>">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="sub-menu">
        <a class="" href="javascript:;">
          <i class="fa fa-product-hunt"></i>
          <span>Products</span>
        </a>
        <ul class="sub">
          <li class=""><a  href="<?php echo e(url('seller/dashboard/new_product')); ?>">New Product</a></li>
          <li class=""><a  href="<?php echo e(url('seller/dashboard/ordered_items')); ?>">Ordered Products</a></li>
          
        </ul>
      </li>          
     
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
    <!--sidebar end-->