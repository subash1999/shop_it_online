@extends('public/layout/public_layout')
@section('center_content')
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">Confirm your Order By Email</div>
            	<div class="card-body">
            		<p>A link has been sent to the email address you have entered so please confirm your validity by clicking on the link is sent to your email </p>
            		<a href="{{ url('/') }}"><button type="button" class="btn btn-lg btn-primary">OK</button></a>		
            	</div>
            </div>
        </div>
    </div>
@endsection
{{-- Assets relating to this page --}}
@section('pagewise_assets')
{{-- cart custom css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/cart_responsive.css') }}">
@endsection