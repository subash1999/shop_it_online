 <!-- **********************************************************************************************************************************************************
TOP BAR CONTENT & NOTIFICATIONS
*********************************************************************************************************************************************************** -->
<!--header start-->
<header class="header black-bg">
  <div class="sidebar-toggle-box">
    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
  </div>
  <!--logo start-->
  <a href="<?php echo e(url('/')); ?>" class="logo"><b><?php echo e(config('app.name')); ?><span style="margin-left: 10px"><img src="<?php echo e(asset('img/system/favicon.ico')); ?>" alt=""></span></b></a>
  <!--logo end-->
  <div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">     
    </div>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
        <li>
          <a class="logout" href="<?php echo e(route('logout')); ?>"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <?php echo e(__('Logout')); ?>

        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
        </form></li>
      </ul>
    </div>
  </header>
    <!--header end-->