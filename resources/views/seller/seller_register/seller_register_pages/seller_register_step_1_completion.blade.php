@extends('seller/seller_register/seller_register_layout/seller_register_layout')

@section('form')

<!------ Include the above in your HEAD tag ---------->
<div class="container align-content-center" >
	{{-- <div class="btn alert-primary btn-block " >
		<label style="color: white;font-size: 14px;">STEP 1 : User Info</label>
	</div> --}}
	<div class="row" style=" float: center; align-self: center;">

	</div>
	<div class="card">
		<h3 class="card-header" align="center" style="float: center;">Step <span class="badge badge-info">1</span> Finished</h3>
		<div class="alert alert-success text-xl-center">
			<div class="alert-heading" style="font-size: 18px;">
				Seller Created Successfully
			</div>
			<div class="">
				@php
				$user = session('user')	
				@endphp
				User ID : <b> {{$user->user_id}} </b> <br>
				Username : <b> {{$user->username}} </b> <br>
				Email : <b> {{$user->email}} </b> <br>
				{{-- User ID : <b>  </b> <br> --}}
				{{-- Username : <b> </b> <br> --}}
				{{-- Email : <b>  </b> <br> --}}
			</div>
		</div>
		<div class="card-body">
			<ol><b>Congratulation !!!</b> You have completed the first step of the seller registration.</ol><br><ol> Please complete the regestration by providing other info otherwise your account will <b>automatically be deleted after the 1 week.</b></ol> <br>
			<ol>If other datas are not provied with in time <b>you won't be able to sell product or go to the seller's dashboard</b>.</ol><br>
			<ol>When you want to fill other info, <b>you have to login </b>then you will be taken to the registration completion form automatically</ol>
			<div style="float: right;" class="form-inline ">
				<form method="get" action="{{ url('seller/register/step2') }}" class="m-2">
					@csrf
					@method('get')
					<input type="submit" class="btn btn-primary" name="Submit" value="Fill Out Other Info">
					<input type="hidden" value="{{$user}}" name="user">
				</form>
				<a href="{{ url('/') }}"><button  class="btn btn-danger">Continue Later</button></a>
				
			</div>
		</div>
	</div>

</div>

</div>
@endsection

@section('pagewise_assets')
<link rel="stylesheet" type="text/css" href="{{ asset('page_assets/seller/register/css/seller_register_step_1_completion.css') }}">
<script src="{{ asset('page_assets/seller/register/js/seller_register_step_1_completion.js') }}"></script>
@endsection