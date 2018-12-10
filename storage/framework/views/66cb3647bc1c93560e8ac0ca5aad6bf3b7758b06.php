<!-- EXTENDING THE ADMIN LAYOUT -->



<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
<?php $__env->startSection('center-content'); ?>	
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Users of Shop IT Online</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!--/.row to inculde the table 	 -->    
		<div class="row"  >
			<div class="col-lg-12" >
				<div class="panel panel-default">
					<div class="panel-heading" >
						List of All The Users of Shop IT Online
					</div>
					<!-- /.panel-heading -->
                  <div class="panel-body" style="overflow-x: scroll;">
                    <table width="100%" class="table  hover order-column table-bordered display" id="all_users_data_table" >
                        <thead>
                            <tr>
                                <th width="15%">S.N</th>
                                <th width="35%">Username</th>
                                
                                <th width="35%">Users Type Roles</th>
                                <th width="15%">Action</th>
                            </tr>
                            <tr id="filterrow">
                                <td></td>
                                <th>Username</th>
                                
                                <th>Users Type Roles</th>    
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
       
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>

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
<script src="<?php echo e(asset('api/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js')); ?>"></script>

<!-- Script for the custom datatable for sio app -->
<script src="<?php echo e(asset('api/datatables/sio_datatable.js')); ?>"></script>


<script src="<?php echo e(asset('api/bootpopup/bootpopup.js')); ?>"></script>


<script src="<?php echo e(asset('api/bootbox/bootbox.js')); ?>"></script>

<?php echo $__env->make('admin/sb_admin/admin_pages/admin_users/js_admin_users_all_users', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/sb_admin/admin_layouts/admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>