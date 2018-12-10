<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<title>{{ $admin_name }} : Admin Panel</title>
		@include('layouts/favicon')
		@include('admin/adminlte/admin_layouts/admin_dashboard_links')
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			@include('admin/adminlte/admin_layouts/admin_nav_bar')
			@include('admin/adminlte/admin_layouts/admin_sidebar') 
			@yield('center_content') 
		</div>
		
		@include('admin/adminlte/admin_layouts/admin_dashboard_scripts')
	</body>
</html>