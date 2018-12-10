<!-- EXTENDING THE ADMIN LAYOUT -->

<?php $__env->startSection('center-content'); ?>
<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->

<div id="page-wrapper">
  <div class="row"> 
    <div class="col-lg-9">
      <div class="row"> 
        <div class="col-lg-12">
          <h1 class="page-header">User Types</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">

            <div class="panel-heading">
              List of Different Types of Users in <?php echo e(config('app.name')); ?>

            </div>

            <!-- /.panel-heading -->
            <div class="panel-body" style="overflow-x: scroll;">
              <div style="margin: 5px;">
                <button class="btn-success" style="margin: 5px;" onclick="restoreUserType()">Restore All Deleted User Types</button>
                <button class="btn-info" onclick="refreshUserTypesTable()" style="float: right;margin: 5px;">Refresh Table</button>
              </div>
              <table width="100%" class="table row-border hover order-column table-bordered display" id="user_types_data_table" >
                <thead>
                  <tr>
                    <th width="10%">S.N</th>
                    <th width="30%">User Type</th>
                    <th width="35%">Number of Users</th>
                    <th width="25%">Action</th>
                  </tr>
                  <tr id="filterrow">
                    <td></td>
                    <th>User Type</th>
                    <th>Number of Users</th>    
                    <td></td>               
                  </tr>
                </thead>              
              </table>
              <!-- /.table-responsive -->

            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="col-lg-3">
      <div class="row">
        <div >
          <h2 class="page-header">Add New User Type</h2>
        </div>
      </div>
      <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading">
            New User Type Form
          </div>
          <div class="panel-body">
            <form id="add_user_type_form" method="post">
             <div class="form-group">
               <label for="admin_type">New User Type</label>
               <input style="height: 40px; width: 90%;" type="text" id="new_admin_type"  placeholder="Type of New User" class="center-block" required="required"autocomplete="off">
             </div>
             <input type="submit" name="submit_btn" value="Add New User Type" class="btn-block btn-success" ></input>
           </form>
         </div>
       </div>
       <!-- /.row -->
     </div>
     <!-- /.row -->
   </div>
   <?php $__env->stopSection(); ?>

   <?php $__env->startSection('pagewise_assets'); ?>
   
   <!-- Pagewise assets of the user_type page in admin panel inside users -->


   <!-- Links for the datatable --> 

   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('api/datatables/datatables.min.css')); ?>">

   <!-- Customize the datatable for this application -->
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('api/datatables/sio_datatable.css')); ?>">

   <style type="text/css">
   input {
     /* width: 60%; */
     padding: 2px 2px;
     margin: 0px 0;
     display: inline-block;
     border: 1px solid #ccc;
     border-radius: 4px;
     width: auto;
   }
 </style>
 
 <!-- Datatable scripts -->
 <script src="<?php echo e(asset('api/datatables/datatables.min.js')); ?>"></script>
 
 <script src="<?php echo e(asset('api/bootpopup/bootpopup.js')); ?>"></script>
 
 <script src="<?php echo e(asset('api/bootbox/bootbox.min.js')); ?>"></script>
 <script>
  window.get_user_types_table_url = "<?php echo e(URL::to('admin/users/user_types/get_table')); ?>"; 
</script>
<!-- Script written in the blade.php for the writing of php in js code -->
<?php echo $__env->make('admin/sb_admin/admin_pages/admin_users/js_admin_users_user_types', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Script for the custom datatable for user_type -->





<script >



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/sb_admin/admin_layouts/admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>