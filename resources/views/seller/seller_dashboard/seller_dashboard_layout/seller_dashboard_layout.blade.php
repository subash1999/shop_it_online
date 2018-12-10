<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="sellers dashboard in shop it online">
	<meta name="author" content="Subash">
	<meta name="keyword" content="Shop It Online,Seller, Dashboard">
	<meta name="_token" content="{{csrf_token()}}" />
	<title>{{ Auth::user()->username }} : Seller Dashboard</title>
	<!-- js placed at the end of the document so the js can be written -->
	<script src="{{ asset('page_assets/seller/dashio/lib/jquery/jquery.min.js') }}"></script>
	@include('layouts.favicon')
	@include('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_links')
</head>
<body>

@include('reuseable_codes/page_loader')
	<section id="container">
		
		{{-- top navigation bar --}}
		@include('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_navbar')
		
		{{-- side bar  --}}
		@include('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_sidebar')
		
		<section id="main-content">
			<section class="wrapper">
				<div class="row">
					{{-- main center content --}}
					@yield('center_content')
				</div>
			</section>
		</section>
		{{-- go to top button --}}
		@include("layouts.go_to_top_btn")

	</section>
	@include('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_scripts')
	@yield('pagewise_assets')
	@yield('formwise_asset')
</body>

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
</script>
</html>
