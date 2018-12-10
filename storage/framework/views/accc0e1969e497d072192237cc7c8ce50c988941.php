<?php
$photo = asset('img/system/male.svg');
if(Auth::check()){

	$gender = Auth::user()->getGender();
	if(strcasecmp("Female", $gender)==0||strcasecmp("F", $gender)==0){
		$photo =  asset('img/system/female.png') ;
	}
	if(Auth::user()->getPhoto()!=null){
		$photo = asset('storage/uploads/'.Auth::user()->getPhoto()) ;
	}
	if(Auth::user()->getPhotoUrl()!=null){
		$photo = Auth::user()->getPhotoUrl();
	}
}
?>
<?php $__env->startSection('center_content'); ?>
<div class="container bootstrap snippet">
	
	<div class="row m-3">
		<div class="col-sm-10"><h1 class="h1 username" id="username_at_top"><?php echo e(Auth::user()->username); ?></h1></div>
		<div class="col-sm-2"><a href="javascript::void(0)" class="pull-right"><img id="pp" height="100" width="100" title="profile image" class="rounded-circle img-responsive" src="<?php echo e($photo); ?>" class="img-thumbnail img-responsive" alt=""></a></div>
	</div>
	<hr>	
	<div class="row">
		<div class="col-sm-3 customer_sidebar"><!--left col-->
			<div class="card mb-3 text-center">    
				<div class="card-img-top" id="pp_input_container">
					<img src="<?php echo e($photo); ?>" alt="Profile Pic Input Image" id="pp_input_image">
					<?php
					if (Auth::check()) {
						$user = Auth::user();
						// dd($user->isCustomer());
						if($user->isSeller()||$user->isCustomer()){
							?>
							<form  id="pp_form" name="pp_form" enctype="multipart/form-data">
								<div id="pp_upload_btn" style="cursor: pointer;">       
									<div class="file btn btn-lg btn-primary" style=" position: relative;overflow: hidden;cursor: pointer;">
										Upload
										<input type="hidden" value="<?php echo e(Auth::id()); ?>" name="user_id">
										<input type="file" name="pp_input" id="pp_input" class="text-center center-block" style=" position: absolute;opacity: 0;right: 0;top: 0;cursor: pointer;" />
									</div>
								</div>
							</form>
							<?php
						}
					}
					?>
					<div class="card-title" class="username mt-4" style="font-size: large" id="username_below_side_pp"><?php echo e(Auth::user()->username); ?></div>
				</div>  
			</div>   


			<div class="card mb-3" >
				<div class="card-header card-info">Account</div>
				<div class="card-body">
					<ul>
						<li class="font-weight-bold mb-2"><a href="<?php echo e(url('customer/')); ?>">Manage My Account</a></li>
						<li>
							<ul class="ml-2">
								<li class="m-2"><a href="<?php echo e(url('customer/profile')); ?>">My Profile</a><i class="fa fa-dashboard fa-1x"></i></li>
								<li class="m-2"><a href="<?php echo e(url('customer/profile')); ?>">Address</a><i class="fa fa-dashboard fa-1x"></i></li>
								<li class="m-2"><a href="<?php echo e(url('customer/profile')); ?>">Discount Coupons</a></li>  
							</ul>
						</li>
					</ul>    
				</div>
			</div>
			<div class="card mb-3" >
				<div class="card-header card-info">Products</div>
				<div class="card-body">
					<ul>
						<style type="text/css">

					</style>
					<li class="font-weight-bold mb-2"><a class="user_side_menu_links" href="<?php echo e(url('customer/profile/my_orders')); ?>">My Orders</a></li>
					<li class="font-weight-bold mb-2"><a href="<?php echo e(url('customer/my_wallet')); ?>">My Wallet</a></li>
					<li class="font-weight-bold mb-2"><a href="<?php echo e(url('wishlist')); ?>">My Wishlist</a></li>
					<li class="font-weight-bold mb-2"><a href="<?php echo e(url('cart')); ?>">My Cart</a></li>  
				</ul>    
			</div>
		</div>     

	</div><!--/col-3-->
	<div class="col-sm-9">
		<?php echo $__env->yieldContent('customer_center_content'); ?>
	</div><!--/col-sm-9 the center content for the customer page ends here-->
</div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pagewise_assets'); ?>

<script src="<?php echo e(asset('one_tech/js/cart_custom.js')); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_responsive.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('api/number_picker/src/dpNumberPicker-2.x-skin.grey.css')); ?>">
<?php
if (Auth::check()) {
	$user = Auth::user();
	if($user->isSeller()||$user->isCustomer()){
		?>
		
		<style type="text/css">
		#pp_input_image {
			opacity: 1;
			display: block;
			width: 100%;
			height: auto;
			transition: .5s ease;
			backface-visibility: hidden;
		}
		#pp_upload_btn {
			transition: .5s ease;
			opacity: 0;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			text-align: center;
		}

		#pp_input_container:hover #pp_input_image {
			opacity: 0.3;    
		}

		#pp_input_container:hover #pp_upload_btn {
			opacity: 1;
		}	
	</style>
	
	<script >
		$(document).ready(function() {
			function updatePPInDb(input) {
				var formData = new FormData($("#pp_form")[0]);
				console.log($("#pp_input"));
				$.ajax({
					url: '<?php echo e(url('customer/profile/change_pp/')); ?>',
					type: 'POST',
					dataType: "json",					
					cache:false,
					contentType: false,
					processData: false,
					data: {form_data: formData},
				})
				.done(function(result) {
					if(result * 1){
						$.notify(
						{
							title:"<b>Profile Pic Changed Successfully</b>",
							message : "Your PP was changed",
						},
						{
							type:"success",
						}
						);
						changePP(input);
					}
					else{
						$.notify(
						{
							title:"<b>Profile Pic Change Failed</b>",
							message : "Your PP was not changed",
						}
						,{
							type:"danger",
						}
						);
					}
				})
				.fail(function() {
					$.notify(
					{
						title:"<b>Ajax error :: Profile Pic Change Failed</b>",
						message:"Your PP was not changed due to Ajax error",
					}
					,{
						type:"danger",
					}
					);
				})
				
				
			}
			var changePP = function(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#pp_input_image').attr('src', e.target.result);
						$('#pp').attr('src', e.target.result);

					}

					reader.readAsDataURL(input.files[0]);
				}
			}


			$("#pp_input").on('change', function(){
				updatePPInDb(this);
				// changePP(this);
				
			});
		}); 
	</script>
	<?php
}
}
?>

<style type="text/css">
.customer_sidebar a {
	text-decoration: none;
}
.customer_sidebar a:link, .customer_sidebar a:visited {
	color: black;
}
.customer_sidebar a:hover {
	color: #17a2b8;
	text-decoration: underline;
	cursor: pointer;

}
</style>
<?php echo $__env->yieldContent('customer_pagewise_assets'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>