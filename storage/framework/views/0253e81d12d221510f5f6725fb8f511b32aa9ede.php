<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(Auth::user()->username); ?> : Admin Control</title>
    <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
    <?php echo $__env->make('layouts.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.sb_admin.admin_layouts.admin_links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- jQuery -->
   <script src="<?php echo e(asset('sbadmin2/vendor/jquery/jquery.min.js')); ?>"></script>
    
 
</head>
<body>
    <?php echo $__env->make('reuseable_codes/page_loader', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            
            
            <?php echo $__env->make('admin.sb_admin.admin_layouts.admin_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <?php echo $__env->make('admin.sb_admin.admin_layouts.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        </nav>
                
        <?php echo $__env->yieldContent('center-content'); ?>
    </div>
    <?php echo $__env->make("layouts.go_to_top_btn", \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /#wrapper -->
  
    <?php echo $__env->make('admin.sb_admin.admin_layouts.admin_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('pagewise_assets'); ?>
</body>
<script >
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
</script>
</html>