<!-- Navigation -->

<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><b><?php echo e(config('app.name')); ?></b></a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right"><div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
   
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo e(asset('prof_pic.jpeg')); ?>" class="user-image" alt="User Image"/>
        
           
              <span class="hidden-xs"><?php echo e(Auth::user()->username); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo e(asset('prof_pic.jpeg')); ?>" class="img-circle" alt="User Image" />
                <p style="-webkit-text-fill-color: black;">
                 <?php echo e(Auth::user()->username); ?> - SIO Admin
                 <small>Member since <?php echo e(Auth::user()->created_at); ?></small>
               </p>
             </li>           
             <!-- Menu Footer-->
             <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
               <a class="logout" href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
               <?php echo e(__('Logout')); ?>

             </a>
             <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
              <?php echo csrf_field(); ?>
            </form>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>
</ul>
<!-- /.navbar-top-links -->


