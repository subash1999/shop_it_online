<!-- Navigation -->

<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="{{ url('/') }}"><b>{{config('app.name')}}</b></a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right"><div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
   
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset('prof_pic.jpeg') }}" class="user-image" alt="User Image"/>
        {{-- the code below is for includeing the helper function in the gvien file --}}
           {{--  @php
              include (app_path() . '\helpers\admin\helper_admin_dashboard.php');
              @endphp --}}
              <span class="hidden-xs">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('prof_pic.jpeg') }}" class="img-circle" alt="User Image" />
                <p style="-webkit-text-fill-color: black;">
                 {{ Auth::user()->username }} - SIO Admin
                 <small>Member since {{ Auth::user()->created_at }}</small>
               </p>
             </li>           
             <!-- Menu Footer-->
             <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
               <a class="logout" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>
</ul>
<!-- /.navbar-top-links -->


