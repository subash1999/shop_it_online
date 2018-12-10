@extends('public/layout/public_layout')
@section('center_content')
<div class="shop">
	<div class="container">
		<div class="row">
			@include('public/pages/all_products/head')
			@include('public/pages/all_products/sidebar')

			@include('public/pages/all_products/center_shop')
		</div>
	</div>
</div>

@include('public/pages/all_products/recent_review')
@endsection
@section('pagewise_assets')
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/shop_responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">

<script src="{{ asset('one_tech/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('one_tech/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('one_tech/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
{{-- a little change script --}}
@include('public/pages/all_products/js_shop_custom')

@endsection