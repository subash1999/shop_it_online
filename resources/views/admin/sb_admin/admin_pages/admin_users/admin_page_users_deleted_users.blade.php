<!-- EXTENDING THE ADMIN LAYOUT -->
@extends('admin/sb_admin/admin_layouts/admin_layout')


<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
@section('center-content')	
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Deleted Users of Shop IT Online</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!--/.row to inculde the table 	 -->    
		<div class="row"  >
      <div class="row"  >
        <div class="col-lg-12" >
          <div class="panel panel-default">
            <div class="panel-heading" >
              List of the <label style="color: red;">DELETED</label> Users of Shop IT Online
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body danger" style="overflow-x: scroll;">
              <table width="100%" class="table  hover order-column table-bordered display" id="deleted_all_users_data_table" >
                <thead>
                  <tr>
                    <th width="15%">S.N</th>
                    <th width="35%">Username</th>
                    {{-- <th>Name</th> --}}
                    <th width="35%">Users Type Roles</th>
                    <th width="15%">Action</th>
                  </tr>
                  <tr id="filterrow">
                    <td></td>
                    <th>Username</th>
                    {{-- <th>Name</th> --}}
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
        <!-- /.col-lg-12 -->
      </div>	
    </div>
  </div>
  @endsection
  @section('pagewise_assets')
  {{-- Links for the page --}}
  <!-- Links for the datatable --> 

  <link rel="stylesheet" type="text/css" href="{{ asset('api/datatables/datatables.min.css') }}">

  <!-- Customize the datatable for this application -->
  <link rel="stylesheet" type="text/css" href="{{ asset('api/datatables/sio_datatable.css') }}">

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
<script src="{{ asset('api/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('api/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>

<!-- Script for the custom datatable for sio app -->
<script src="{{ asset('api/datatables/sio_datatable.js') }}"></script>

{{-- bootpopup js --}}
<script src="{{ asset('api/bootpopup/bootpopup.js') }}"></script>

{{-- Bootbox js  --}}
<script src="{{ asset('api/bootbox/bootbox.min.js') }}"></script>
{{-- INCLUDING THE Javascript of the page i.e the js is in the blade.php because of php prasing --}}
@include('admin/sb_admin/admin_pages/admin_users/js_admin_users_deleted_users')
@endsection