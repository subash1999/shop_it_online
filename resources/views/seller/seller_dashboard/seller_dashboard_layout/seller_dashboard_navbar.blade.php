 <!-- **********************************************************************************************************************************************************
TOP BAR CONTENT & NOTIFICATIONS
*********************************************************************************************************************************************************** -->
<!--header start-->
<header class="header black-bg">
  <div class="sidebar-toggle-box">
    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
  </div>
  <!--logo start-->
  <a href="{{ url('/') }}" class="logo"><b>{{config('app.name')}}<span style="margin-left: 10px"><img src="{{ asset('img/system/favicon.ico') }}" alt=""></span></b></a>
  <!--logo end-->
  <div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">     
    </div>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
        <li>
          <a class="logout" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form></li>
      </ul>
    </div>
  </header>
    <!--header end-->