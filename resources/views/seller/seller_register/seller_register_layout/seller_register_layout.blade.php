<!DOCTYPE html>
<html>
<head>
	<title>Seller Registration :{{ config('app.name', 'SIO') }}</title>
	<meta name="_token" content="{{csrf_token()}}" />
	@include('layouts.favicon')
	@include('seller/seller_register/seller_register_layout/seller_register_links')
	{{-- <script src="{{ asset('css/app.css') }}"></script> --}}
</head>
<body>
	@include('layouts.nav')
	<div id="seller_step1_form">
	@yield('form')
	</div>
</body>
@include('seller/seller_register/seller_register_layout/seller_register_scripts')

@yield('pagewise_assets')
<script >
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
</script>
</html>
