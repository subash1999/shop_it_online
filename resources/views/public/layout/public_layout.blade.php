<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="shop it online">
	<meta name="author" content="Subash">
	<meta name="keyword" content="Shop It Online,Public, Home">	
	<title>{{config('app.name')}}</title>
	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- js placed at the end of the document so the jqery can be written -->
	<script src="{{ asset('one_tech/js/jquery-3.3.1.min.js') }}"></script>

	@include('layouts.favicon')
	@include('public/layout/public_links')
</head>
<body>

	{{-- Pre loader before loading the page fully --}}
	@include('reuseable_codes/page_loader')
	<div class="super_container">
		{{-- Header of the page  --}}
		@include('public/layout/public_header')

		{{-- Center content of the page --}}
		@yield('center_content')

		{{-- Footer of the page --}}
		@include('public/layout/public_footer')
		{{-- go to top button --}}
		@include('layouts/go_to_top_btn')
	</div>
	@include('public/layout/public_scripts')
	@yield('pagewise_assets')
		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>

</body>

</html>
