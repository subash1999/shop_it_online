@extends('mails/layouts/layouts')
@section('title')
OrderConfirmation
@endsection
@section('center')
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3">Someone Wants to contact you</h3>
		<div class="row">
			<div class="card">
			<div class="card-header">General Info</div>
			<div class="card-body">
				<div class="row">Name : {{ $data->name }}</div>
				<div class="row">Email : {{ $data->email }}</div>
				<div class="row">Phone Number : {{ $data->phone }}</div>
			</div>
		</div>
		</div>
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