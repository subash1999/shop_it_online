@extends('mails/layouts/layouts')
@section('title')
Mail From Site
@endsection
@section('center')
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3">{{ $data->title }}</h3>
		<h4 class="h4">Subject : {{ $data->subject }}</h4>
		<hr>
		<h3 class="h3 text-muted">Message</h3>
		<hr>
		<div>
			<p>{{ $data->message }}</p>
		</div>
	</div>
</div>
<style>
@include('mails/assets/cart_styles_css')
@include('mails/assets/cart_responsive_css')
</style>
@endsection