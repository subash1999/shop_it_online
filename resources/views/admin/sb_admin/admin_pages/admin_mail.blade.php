
@extends('admin/sb_admin/admin_layouts/admin_layout')

<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
@section('center-content')	
<div id="page-wrapper">
	
<!-- Contact Form -->

<div class="contact_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_form_container">
					<div class="contact_form_title" align="middle"><h2 class="h2">Send Mail From Site</h2></div>
					@if ($success!=null)
						<div class="alert alert-success">
							{{ $success }}
						</div>
					@endif
					@foreach ($errors->all() as $error)
					<div class="alert-danger alert">
						<li>{{ $error }}</li>
					</div>
					@endforeach

					<form action="{{ url('admin/send_mail') }}" id="contact_form" method="post">
						@csrf
						@method('post')
						<input type="hidden" name="title" value="Message From System Admin">
						<div class="container-fluid">
							<div class="form-group m-5">
								<label for="email" >Select User : </label>
								<select name="email" class="form-control" id="" value="{{ old('email') }}">
									@foreach ($users as $user)
										<option value="{{ $user->email }}">{{ $user->username }}</option>
									@endforeach
								</select>
							
							</div>	
							<div class="form-group m-3" ></label>
								<label for="subject" class="form-control-label">Subject :</label>
								<input name="subject" class="form-control" id="subject" value="{{ old('subject') }}">
							
							</div>							
						</div>
						<div class="form-group" style="width: 100%;align-content: center;">
							<textarea id="contact_form_message" style="width: 100%;" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message." class="form-control" cols="30" rows="10">{{ old('message') }}</textarea>
						</div>
						<div class="contact_form_button">
							<button type="submit" class="btn btn-primary btn-lg">Send Message</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="panel"></div>
</div>

</div>

@endsection
@section('pagewise_assets')

@endsection