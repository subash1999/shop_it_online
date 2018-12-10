{{-- Here we will include the all the form field necessary for the seller i.e this is the step 2 after the user creation in step 1 --}}
@extends('seller/seller_register/seller_register_layout/seller_register_layout')

@section('form')
<h1 class="font-italic ">Complete Your Registration</h1>

<form id="regForm" action="{{ asset('seller/register/step2') }}" enctype="multipart/form-data" method="post">
	@csrf
	@method('post')	
	@if ($errors->any())
	<div id="errorList">
		<div class="alert-danger" >
			<div class="alert-heading"><u><h4>Lists of Errors on Form</h4></u></div>
			<div class="" width="50%"  >
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	@endif 
	{{-- <h3 class="form-text text-center">Please fill all the info : </h3> --}}
	<div style="text-align:center;margin-top:10px;">
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
	</div>
	<!-- One "tab" for each step in the form: -->
	<div class="tab">
		<h2 style="text-align: center;">Seller Information</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>			
		</div>
		@include('seller/seller_register/seller_register_pages/seller_information_form')
	</div>
	<div class="tab">
		<h2 style="text-align: center;">Company Information</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Company Info</div>			
		</div>
		@include('seller/seller_register/seller_register_pages/company_information_form')
	</div>
	<div class="tab">
		<h2 style="text-align: center;">Contact Information</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Company Info</div>
			<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Contact Info</div>			
		</div>
		@include('seller/seller_register/seller_register_pages/contact_information_form')
	</div>
	<div class="tab">
		<h2 style="text-align: center;">Information Verifcation</h2>
		<div class="progress" style="height: 20px;">
			<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Seller Info</div>
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Company Info</div>
			<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Contact Info</div>
			<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Info Verif..</div>
		</div>
		@include('seller/seller_register/seller_register_pages/information_verification_form')
	</div>
	<div style="overflow:auto;">
		<div style="float:right;">
			<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
			<button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn-info">Next</button>
		</div>
	</div>
	<!-- Circles which indicates the steps of the form: -->

</form>

@endsection

@section('pagewise_assets')
<link rel="stylesheet" type="text/css" href="{{ asset('page_assets/seller/register/css/seller_register_step_2.css') }}">
@include('seller/seller_register/seller_register_pages/js_seller_register_step_2')

@endsection