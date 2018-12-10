<div class="card-body" style="font-size: 18px;">
	<div class="form-group">
		<h3 class="form-control-label"><u>User Info : </u></h3>
		<div class=" form-group">
			<div class="form-inline m-2" >
				<label class="form-control-label">User Id : </label>
				<u><label class="form-control-label" id="user_id_verify" name="user_id_verify"></label></u>
				<input type="hidden" name="user" value="" id="user">
			</div>
			<div class="form-inline m-2">	
				<label class="form-control-label">Username : </label>
				<u><label class="form-control-label" id="username_verify" name="username_verify"></label></u>
				
			</div>
			<div class="form-row">
				<div class="m-2 form-row float-right">	
					<figure style="width: 70%; margin-left: 20px; max-width: 200px;">			
						<img src="{{ asset('img/system/user_photo_placeholder.jpg') }}" alt="User's Photo" class="img-thumbnail" id="user_photo_verify" name="user_photo_verify">
						<figcaption>User Photo</figcaption>
					</figure>
				</div>
				<div class="form-inline m-2">	
					<figure style="width: 70%;margin-left: 20px;">
						<img src="{{ asset('img/system/upload_id.png') }}" alt="User's Identity Proof" class="img-thumbnail" id="user_identity_verify" name="user_identity_verify">
						<figcaption>User's Identity Proof</figcaption>
					</figure>				
				</div>
			</div>
		</div>
		<div class="">
			<div class="form-inline m-2" >
				<label class="form-control-label">Name : </label>
				<u><label class="form-control-label" id="name_verify" name="name_verify">{{old('name_verify')}}</label></u>
			</div>
			<div class="form-inline m-2">	
				<label class="form-control-label">Gender : </label>
				<u><label class="form-control-label" id="gender_verify" name="gender_verify"></label></u>
			</div>
			<div class="form-inline m-2">	
				<label class="form-control-label">Date Of Birth : </label>
				<u><label class="form-control-label" id="dob_verify" name="dob_verify"></label></u>
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<h3 class="form-control-label"><u>Company Info : </u></h3>
		<div class="form-row">
			<div class="form-inline m-2" >
				<label class="form-control-label">Company Name : </label>
				<u><label class="form-control-label" id="company_name_verify" name="company_name_verify"></label></u>
			</div>			
		</div>
		<div class="form-row form-group">
			<div class="form-group m-2" >
				<label class="form-control-label">Company's Cover Photo : </label>
				<figure style="width: 70%; margin-left: 20px;">
					<img src="{{ asset('img/system/upload_photo.png') }}" alt="Company Cover Photo" class="img-thumbnail" id="company_cover_verify" name="company_cover_verify">
					<figcaption>Company Cover Photo</figcaption>
				</figure>				
			</div>			
		</div>
		<div class="form-row form-group">
			<div class="form-group m-2" >
				<label class="form-control-label">Company's Certificate Photo : </label>
				<figure style="width: 70%;margin-left: 20px;">
					<img src="{{ asset('img/system/upload_photo.png') }}" alt="Company Certificate Proof" class="img-thumbnail" id="company_certificate_verify" name="company_certificate_verify" >
					<figcaption>Company Certificate Proof</figcaption>
				</figure>				
			</div>			
		</div>
		<div class="form-row form-group">
			<div class="form-inline m-2 form-group" >
				<label class="form-control-label">Company's Location : </label>		
				<div id="google_map_verify" name="google_map_verify"></div>
				<br>		
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<h3 class="form-control-label"><u>Contact Info : </u></h3>
		<div class="">
			<div class="form-inline m-2" >
				<label class="form-control-label">Email : </label>
				<u><label class="form-control-label" id="email_verify" name="email_verify"></label></u>
			</div>
			<div class="form-inline m-2">	
				<label class="form-control-label">Phone : </label>
				<u><label class="form-control-label" id="phone_verify" name="phone_verify"></label></u>
			</div>	
			<div class="form-inline m-2" >
				<label class="form-control-label">Fax : </label>
				<u><label class="form-control-label" id="fax_verify" name="fax_verify"></label></u>
			</div>		
		</div>
		<div class="">			
			<div class="form-inline m-2">	
				<label class="form-control-label">Country : </label>
				<u><label class="form-control-label" id="country_verify" name="country_verify"></label></u>
			</div>
			<div class="form-inline m-2">	
				<label class="form-control-label">City : </label>
				<u><label class="form-control-label" id="city_verify" name="city_verify"></label></u>
			</div>
		</div>
		<div class="">			
			<div class="form-inline m-2">	
				<label class="form-control-label">Address : </label>
				<u><label class="form-control-label" id="address_verify" name="address_verify"></label></u>
			</div>
			<div class="form-inline m-2">	
				<label class="form-control-label">Postal Code : </label>
				<u><label class="form-control-label" id="postal_code_verify" name="postal_code_verify"></label></u>
			</div>
		</div>
		
	</div>
</div>
<style>
figcaption {
	background-color: #222;
	color: #fff;
	font: italic smaller sans-serif;
	padding: 3px;
	text-align: center;
}

</style>