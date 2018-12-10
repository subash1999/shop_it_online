<!-- EXTENDING THE ADMIN LAYOUT -->


<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
<?php $__env->startSection('center-content'); ?>	


<div id="page-wrapper" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 ">
				<h1 class="page-header" align="center">Add New ADMIN to Shop IT Online</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<form autocomplete="on">
			<div class="row">

				<div class="col-lg-6">
					<div class="panel-info">
						<div class="panel-heading">General Information</div>
					</div>
					<div class="panel-body">
						<div class="form-group row">
							<label for="first_name" class="col-sm-4 col-form-label" style="font-weight: normal">First Name<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="text" name="first_name" class="form-control"  placeholder="First Name"  required="required" autocapitalize="on">
							</div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-sm-4 col-form-label" style="font-weight: normal">Last Name<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="text" name="last_name" class="form-control"  placeholder="Last Name"  required="required" autocapitalize="on">
							</div>
						</div>
						<div class="form-group row">
							<label for="dob" class="col-sm-4 col-form-label" style="font-weight: normal">Date of Birth<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="text" name="dob" class="form-control datepicker" placeholder="mm/dd/yyyy" autocomplete="off" required="required">
							</div>							
						</div>
						<div class="form-group row">
							<label for="dob" class="col-sm-4 col-form-label" style="font-weight: normal">Gender<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="radio" name="gender" value="male" id="male_gender">
								<label for="male_gender" style="font-weight: normal">Male</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" value="female" id="female_gender">
								<label for="female_gender" style="font-weight: normal">Female</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" value="other" id="other_gender">
								<label for="other_gender" style="font-weight: normal">Other</label>
								
							</div>							
						</div>
						
						<div class="form-group row">
							<label for="primary_email" class="col-sm-4 col-form-label" style="font-weight: normal" autocomplete="off">Primary Email<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="email" name="dob" class="form-control" placeholder="primary_email@web.com" required="required" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label for="secondary_email" class="col-sm-4 col-form-label" style="font-weight: normal">Secondary Email</label>
							<div class="col-sm-8">
								<input type="email" name="secondary_email" class="form-control" placeholder="secondary_email@web.com" autocomplete="off">
							</div>
						</div>

					</div>
				</div>
				<div class="col-lg-6">
					<div class="panel-info">
						<div class="panel-heading">Photo and Identity Upload</div>
						<div class="panel-body">

							<div class="col-lg-6" align="center">
								<hr>
								<label for="photo" class=" " style="font-weight: bold">Your Photo<label style="color: red;font-size: 20px;">*</label></label>
								<div class="col-sm-8" >
									<input type='file' onchange="viewPhoto(this);" required="required"/><br>
									<img id="photo" src="<?php echo e(asset('img/system/upload_photo_icon.png')); ?>" style="width: 2;height: 150px;" alt="your Image" />
								</div>
								<hr>
							</div>	

							<div class="col-lg-6" align="left">
								<hr>
								<label for="photo" class=" " style="font-weight: bold">Your Identity Proof<label style="color: red;font-size: 20px;">*</label></label>

								<div class="col-sm-8">
									<input type='file' onchange="viewId(this);" required="required"/><br>
									<img id="id" src="<?php echo e(asset('img/system/upload_photo_icon.png')); ?>" style="width: 150px;height: 150px;" alt="your ID" />
								</div>
								<hr>
							</div>	

						</div>
					</div>
				</div>
				

			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="panel-info">
						<div class="panel-heading">Contact Information</div>
					</div>
					<div class="panel-body">
						<div class="form-group row">
							<label for="permanent_address" class="col-sm-4 col-form-label" style="font-weight: normal">Permanent Address<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="text" name="permanent_address" class="form-control"  placeholder="your permanent address"  required="required" autocapitalize="on">
							</div>
						</div>

						<div class="form-group row">
							<label for="country" class="col-sm-4 col-form-label" style="font-weight: normal">Country<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<select name="country" class="form-control" required="required">
									<?php echo $__env->make('reuseable_codes.select_country_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</select>								
							</div>
						</div>
						<div class="form-group row">
							<label for="city" class="col-sm-4 col-form-label" style="font-weight: normal">City<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="text" name="city" class="form-control"  placeholder="City Name"  required="required">
							</div>
						</div>
						<div class="form-group row">
							<label for="postal_code" class="col-sm-4 col-form-label" style="font-weight: normal">Postal Code</label>
							<div class="col-sm-8">
								<input type="number" name="postal_code" class="form-control"  placeholder="your temporary address"  >
							</div>
						</div>
						<div class="form-group row">
							<label for="temporary_address" class="col-sm-4 col-form-label" style="font-weight: normal">Temporary Address</label>
							<div class="col-sm-8">
								<input type="text" name="temporary_address" class="form-control"  placeholder="your temporary address" autocapitalize="on">
							</div>
						</div>
						<div class="form-group row">
							<label for="phone1" class="col-sm-4 col-form-label" style="font-weight: normal">Contact no 1<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<select class="form-control">
									<?php echo $__env->make('reuseable_codes.select_country_calling_code_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</select>
								<input type="number" name="phone1" class="form-control"  placeholder="eg:- 016615704"  required="required">
							</div>
						</div>
						<div class="form-group row">
							<label for="phone2" class="col-sm-4 col-form-label" style="font-weight: normal">Contact no 2</label>
							<div class="col-sm-8">
								<select class="form-control">
									<?php echo $__env->make('reuseable_codes.select_country_calling_code_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</select>
								<input type="number" name="phone2" class="form-control"  placeholder="eg:- 016615704" >
							</div>
						</div>
						<div class="form-group row">
							<label for="fax" class="col-sm-4 col-form-label" style="font-weight: normal">Fax</label>
							<div class="col-sm-8">
								<select class="form-control">
									<?php echo $__env->make('reuseable_codes.select_country_calling_code_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</select>
								<input type="number" name="fax" class="form-control"  placeholder="eg:- 016615704" >
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="panel-info">
						<div class="panel-heading">User Creation and Form Submission</div>
					</div>
					<div class="panel-body">
						<div class="form-group row">
							<label for="username" class="col-sm-4 col-form-label" style="font-weight: normal;">Username<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="text" name="username" class="form-control"  placeholder="Your unique Username " required="required">
							</div>
						</div>
						<div class="form-group row" id="pwd-container">
							<label for="password" class="col-sm-4 col-form-label" style="font-weight: normal;">Password<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="password" id="password" name="password" class="form-control"  placeholder="Password " required="required" id="password" autocomplete="off">
							</div>
							<div class="col-sm-8" style="padding-top: 30px;">
								<div id="pwstrength_viewport_progress"></div>
							</div>								
							
						</div>
						<div class="form-group row">
							<label for="re_password" class="col-sm-4 col-form-label" style="font-weight: normal;">Re Type Password<label style="color: red;font-size: 20px;">*</label></label>
							<div class="col-sm-8">
								<input type="password" name="re_password" class="form-control"  placeholder="Retype Your Password" required="required" id="retype_password" autocomplete="off">
							</div>
						</div>
						<div class="form-group row">
							<label style="color: orange">Note: The fields with the star(*) are the required fields</label>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								
							</div>
							<div class="col-lg-6">
								<input type="submit" name="submit" style="margin: 10px;" value="SUBMIT Form" class="btn-lg btn-success">
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>

<!-- Script for the page -->
<script src="<?php echo e(asset('api/password_strength_api/pwstrength-bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('page_assets/admin/users/add_admin/admin_users_add_admin.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/sb_admin/admin_layouts/admin_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>