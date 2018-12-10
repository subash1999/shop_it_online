
<div class="form-group">

	<label class="form-control-label" for="name">Name: </label>
	<div class="form-inline">
		<input id="first_name" type="text" maxlength="100" class="form-control" name="first_name"  autocomplete="name"  style="margin-right:15px; margin-top: 5px;" placeholder="First Name..." value="<?php echo e(old('first_name')); ?>">
		<input id="middle_name" type="text" maxlength="100" class="form-control" name="middle_name" autocomplete="name"  style="margin-right: 15px; margin-top:5px;" placeholder="Middle Name...">
		<input id="last_name" type="text" maxlength="100" class="form-control" name="last_name" required="required" autocomplete="name"  style="margin-right: 15px; margin-top:5px;" placeholder="Last Name...">
	</div>
	
</div>
<div class="row">
	<div class="form-group col-auto">
		<label class="form-control-label" for="name">Date of Birth : </label>
		<div class="form-inline">	
			<input id="dob" type="date" maxlength="100" class="form-control" name="dob"  autocomplete="name"  style="margin-right:15px;" placeholder="DOB">
		</div>
	</div>
	<div class="form-inline">
		<label class="form-control-label" for="name">Gender : </label>
		<div class="form-inline m-2">	
			<input  type="radio" class="form-control" name="gender" style="margin-right:15px;" value="Male" checked="checked">
			<label class="form-check-label">Male</label>
		</div>
		<div class="form-inline m-2">
			<input  type="radio" class="form-control " name="gender" style="margin-right:15px;" value="Female">
			<label class="form-check-label">Female</label>
		</div>
		<div class="form-inline m-2">
			<input  type="radio" class="form-control  " name="gender" style="margin-right:15px;" value="Other">
			<label class="form-check-label">Other</label>
		</div>		
	</div>	
</div>
<div class="row">
	<div class="  form-inline">
		<label class="form-control-label m-3">Your Photo : </label>		
		<img id="your_photo_view" class="img-thumbnail" src="<?php echo e(asset('img/system/user_photo_placeholder.jpg')); ?>" alt="profile picture placeholder" width="100px" height="100px" class="img-fluid rounded-circle m-3" style="cursor: pointer;" required="required" name="your_photo_view" >		
		<div class="btn upload_btn" style="cursor: pointer;">
			<button class="btn btn-outline-secondary">Upload Photo</button>
			<input type="file" class="photo_upload_input" name="your_photo_input" id="your_photo_input" onchange="viewPhoto(this);" required="required" accept="image/*">	
		</div>	

	</div>
	<div class="  form-inline">
		<label class="form-control-label m-3">Your Identity Proof : </label>		
		<img id="your_id_view" class="img-thumbnail" src="<?php echo e(asset('img/system/upload_id.png')); ?>" alt="profile picture placeholder" width="100px" height="100px" class="img-fluid rounded-circle m-3" style="cursor: pointer;" required="required" name="your_id_view">
		<div class="btn upload_btn" style="cursor: pointer;">
			<button class="btn btn-outline-secondary">Upload ID</button>
			<input type="file" class="photo_upload_input" name="your_id_input" id="your_id_input" onchange="viewId(this);" required="required" accept="image/*">	
		</div>	

	</div>
</div>
<script >
	
</script>