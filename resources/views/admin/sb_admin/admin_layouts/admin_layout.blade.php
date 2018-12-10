<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Auth::user()->username }} : Admin Control</title>
    <meta name="_token" content="{{csrf_token()}}" />
    @include('layouts.favicon')
    @include('admin.sb_admin.admin_layouts.admin_links')
    <!-- jQuery -->
   <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    {{-- @include('layouts.input_autocomplete') --}}
 
</head>
<body>
    @include('reuseable_codes/page_loader')
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            {{-- nav bar and sidebar of the page --}}
            
            @include('admin.sb_admin.admin_layouts.admin_navbar')
            
            @include('admin.sb_admin.admin_layouts.admin_sidebar')
            
        </nav>
        {{-- Center portion of the  admin  control panel--}}        
        @yield('center-content')
    </div>
    @include("layouts.go_to_top_btn")
    <!-- /#wrapper -->
  
    @include('admin.sb_admin.admin_layouts.admin_scripts')
    @yield('pagewise_assets')
</body>
<script >
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
</script>
</html>