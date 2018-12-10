@extends('seller/seller_register/seller_register_layout/seller_register_layout')

@section('form')

<!------ Include the above in your HEAD tag ---------->
<div class="container">
	{{-- <div class="btn alert-primary btn-block " >
		<label style="color: white;font-size: 14px;">STEP 1 : User Info</label>
	</div> --}}
	<div class="row" style="background-color: white;">
		<div class="card card-primary">
			<div class="panel-body">
				{{-- For printing all the errors on the top --}}
				<!-- @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif -->
				<form method="POST" action="{{ url('/seller/register/create_account') }}" role="form" >
					@csrf
					@method('post')					
					<div class="form-group">
						<img src="{{ asset('img/system/website_logo.png') }}" alt="Website Logo" class="mx-auto d-block img-fluid rounded" style="height: 60px">
					</div>
					<div class="form-group">
						<h4>Create Sellers account</h4>
					</div>
					<div class="form-group">
						<label class="control-label" for="username" autoComplete="username">Username</label>
						<input id="username" type="text" maxlength="100" class="form-control" name="username" required="required">
						@if ($errors->has('username'))
						<br>
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->get('username') as $message)
								<li>{{ $message }}</li>								
								@endforeach
							</ul>
						</div>
						@endif
					</div>
					<div class="form-group">
						<label class="control-label" for="email">Email</label>
						<input id="email" type="email" maxlength="100" class="form-control" name="email" required="required" autocomplete="email">
						@if ($errors->has('email'))
						<br>
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->get('email') as $message)
								<li>{{ $message }}</li>								
								@endforeach
							</ul>
						</div>
						@endif
					</div>	
					<div class="form-group " id="pwd-container">
						<label class="control-label" for="password">Password</label>						
						<input id="password" type="password" minlength="6" maxlength="25" class="form-control" placeholder="at least 6 characters" length="50" name="password" required="required" autocomplete="new-password">
						
						<div id="pwstrength_viewport_progress" style="margin: 5px;"></div>
					</div>				
					@if ($errors->has('password'))
						<br>
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->get('password') as $message)
								<li>{{ $message }}</li>								
								@endforeach
							</ul>
						</div>
						@endif	

					<div class="form-group">
						<label class="control-label" for="password_confirmation">Password confirmation</label>
						<input id="password_confirmation" type="password" maxlength="25" class="form-control" name="password_confirmation" required="required" autocomplete="new-password">
						@if ($errors->has('password_confirmation'))
						<br>
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->get('password_confirmation') as $message)
								<li>{{ $message }}</li>								
								@endforeach
							</ul>
						</div>
						@endif
					</div>
					<div class="form-group">
						<button id="signupSubmit" type="submit" class="btn btn-info btn-block">Create your account</button>
					</div>
					<p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
					<hr>
					<p>Already have an account? <a href="#">Sign in</a></p>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('pagewise_assets')
<script src="{{ asset('password_strength_api/pwstrength-bootstrap.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('page_assets/seller/register/css/seller_register_step_1.css') }}">
<script src="{{ asset('page_assets/seller/register/js/seller_register_step_1.js') }}"></script>
@endsection