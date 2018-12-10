@extends('admin/admin_layouts/admin_layout')

{{-- Center content of the page --}}
@section('center_content')
<div id="center_division">


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li class="active">Users</li>
        <li class="active">All Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          Subash
        </div>
        <div class="col-lg-3 col-xs-6">
          Niroula
        </div>
        <div class="col-lg-3 col-xs-6">
          Apple
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          Ball
        </div><!-- ./col -->
        
      </div><!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <table class="table table-striped ">
            <thead class="lighten-4 blue-grey">
              @php
                $users = new App\Http\Controllers\Admin_Panel\UsersAllUsersController();
              
              $columns = $users->getColumnNames();
              @endphp
              <tr>
              @for ($i=0;$i<count($columns) ;$i++)
                @if (count($columns[$i])>0)
                  <th>{{$columns[$i]}}</th>
                @endif
                
              @endfor
            </tr>
            </thead>
          </table>
        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        </section><!-- right col -->
      </div><!-- /.row (main row) -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper --> 
</div>
@endsection
