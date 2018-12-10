<?php $__env->startSection('center_content'); ?>

<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="cart_container">
					<div class="cart_title">Wishlist</div>
					<div class="cart_title h4">Total Products : <label class="total_wishlist_items"><?php echo e(count($wl_items)); ?></label></div>
					<div class="cart_items">
						<ul class="cart_list">
							<?php $__currentLoopData = $wl_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $wl_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
							<li class="cart_item clearfix" id="cart_item_<?php echo e($key); ?>">
								<div class="cart_item_image"><a href="<?php echo e(url('product')); ?>/<?php echo e($wl_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo e(asset('storage/uploads/'.$wl_item["photo"])); ?>" alt=""></a></div>
								<div class="wl_item_info d-flex flex-md-row flex-column justify-content-between">
									<div class="cart_item_name cart_info_col">
										<div class="cart_item_title">Name</div>
										<div class="cart_item_text"><a href="<?php echo e(url('product')); ?>/<?php echo e($wl_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($wl_item["name"]); ?></a></div>
									</div>
									<div class="cart_item_color cart_info_col">
										<div class="cart_item_title">Option</div>
										<div class="cart_item_text"><?php echo e($wl_item["option"]); ?></div>
									</div>
									<div class="cart_item_price cart_info_col">
										<div class="cart_item_title">Unit Price</div>
										<div class="cart_item_text"><?php echo e($wl_item['currency_symbol']); ?> <label id="unit_price_<?php echo e($key); ?>"> <?php echo e($wl_item["unit_price"]); ?></label></div>
									</div>
									<div class="cart_item_total cart_info_col">
										<div class="cart_item_title">Action</div>
										<div style="margin-top: 35px;font-size: 24px;">
											<i class="fa fa-shopping-basket"
											onclick="addToCart(<?php echo e($wl_item['sp_id']); ?>,'<?php echo e($wl_item['spor_id']); ?>',<?php echo e($key); ?>)" style="cursor: pointer;color:#28a745"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											
											<i id="delete_btn_<?php echo e($key); ?>" class="far fa-trash-alt" title="Delete" style="cursor: pointer;color:red;" aria-hidden="true" onclick="deleteWishlistItem(<?php echo e($wl_item['sp_id']); ?>,'<?php echo e($wl_item['spor_id']); ?>',<?php echo e($key); ?>)"></i>											
										</div>
									</div>
								</div>
							</li>
							<hr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
					<div>
						<?php echo e($wl_items->links()); ?>

					</div>
				
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>

<script src="<?php echo e(asset('one_tech/js/cart_custom.js')); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_responsive.css')); ?>">

<script type="text/javascript">
	function addToCart(sp_id,spor_id,key) {
		// While adding to cart form the wishlist the quantity is always 1
		var qty = 1;
		if(spor_id==""){
			spor_id = null;
			addSellerProductToCartClick(sp_id,qty);
		}
		else{
			addSPORToCart(spor_id,qty);
		}

	}
	function deleteWishlistItem(sp_id,spor_id,key) {
		bootbox.confirm({
			title: "Item will be deleted from Wishlist",
			message : "Are you sure? You Can simply move it to cart if it is here",
			buttons:{
				confirm: {
					label: 'Delete From Wishlist',
					className: 'btn-danger',
				},
				cancel: {
					label: 'Cancel',
					className: 'btn-warning',
				},			
			},
			backdrop: true,
			onEscape : true,
			callback :function (result){
				if(result==true){
					if(spor_id==""){
						spor_id = null;
						removeProductInWishlist(sp_id,key);
					}
					else{
						removeProductOptionInWishlist(spor_id,key);
					}		
				}
			}
		});				
	}
</script>

<script type="text/javascript">
	function addSellerProductToCartClick(sp_id,number_of_items) {
		if(number_of_items<=0){
			number_of_items=1;
		}
		$.ajax({
			url: '<?php echo e(url('product/add_sp_in_cart')); ?>',
			type: 'POST',
			data: {number_of_items: number_of_items,
				sp_id : sp_id,
			},
		})
		.done(function(result) {
			result = $.trim(result);
			var message="",title="",type = "";
			if("true".localeCompare(result)===0){
				title = "<b>Cart Success :</b>(From Wishlist)<br> ";
				message = number_of_items+" Item of Product is successfully added to cart from wishlist";
				type = "success";
			}
			else if("false".localeCompare(result)===0){
				title = "<b>Cart Failure : </b>(From Wishlist)<br>";
				message = number_of_items+" Item of Product Cannot be added to the cart from wishlist";
				type = "danger";
			}
			else{
				title = "<b>Cart Message : </b>(From Wishlist)<br> ";
				message = result;
				type="warning";
			}
			$(document).ready(function() {

				$.notify({
					title : title,
					message : message,
				},
				{				
					type : type,
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},									

				});	
			});
		})
		.fail(function(error,textStatus) {
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax : </b><br> "  ,
					message : "Adding product to cart from wishlist page. Error occured is "+textStatus,
				},
				{
					type : "danger",
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},

				},

				);
			});
		})
		.always(function(){
			$(document).ready(function() {
				refreshWishlistAndCart();
			});
		})

	}

	function addSPORToCart(spor_id,number_of_items) {		
		$.ajax({
			url: '<?php echo e(url('product/add_spor_in_cart')); ?>',
			type: 'POST',
			data: {
				'spor_id': spor_id,
				'number_of_items' : number_of_items,
			},
		})
		.done(function(result) {				
			result = $.trim(result);
			var message="",title="",type = "";
			if("true".localeCompare(result)===0){
				title = "<b>Cart Success :</b><br> ";
				message = number_of_items+" Item of Product Option is successfully added to cart";
				type = "success";
			}
			else if("false".localeCompare(result)===0){
				title = "<b>Cart Failure : </b><br>";
				message = number_of_items+" Item of Product Option Cannot be added to the cart";
				type = "danger";
			}
			else{
				title = "<b>Cart Message : </b><br>";
				message = result;
				type="warning";
			}
			$(document).ready(function() {
				$.notify({
					title : title,
					message : message,
				},
				{				
					type : type,
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},								
					
				});	
			});
		})
		.fail(function(error,textStatus) {
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax : </b><br> "  ,
					message : "Adding product option to cart. Error occured is "+textStatus,
				},
				{
					type : "danger",
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},


				},

				);
			});
		}).always(function(){
			$(document).ready(function() {
				refreshWishlistAndCart();
			});
		});
		
	}
	function removeProductInWishlist(sp_id,key){		
		$.ajax({
			url: '<?php echo e(url('product/remove_sp_in_wishlist')); ?>',
			type: 'POST',
			data: {sp_id: sp_id},
		})
		.done(function(result) {
			result = $.trim(result);
			var message="",title="",type = "";
			if("true".localeCompare(result)===0){
				title = "<b>Wishlist Remove Success :</b>(From Wishlist)<br> ";
				message = "Product is removed from the wishlist";
				type = "danger";
				removeItemFromWishlist(key);
			}
			else{
				title = "<b>Wishlist Failure : </b>(From Wishlist)<br>";
				message = "Product cannot be removed from the wishlist";
				type = "Warning";
			}
			$(document).ready(function() {
				$.notify({
					title : title,
					message : message,
				},
				{				
					type : type,
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},

				});	
			});
		})
		.fail(function(error,textStatus) {
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax :</b>(From Wishlist)<br> "  ,
					message : "Removing product from wishlist. Error occured is "+textStatus,
				},
				{
					type : "danger",
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},											
				},

				);
			});
		})
		.always(function(){
			$(document).ready(function() {
				refreshWishlistAndCart();
			});
		});

	}
	// for the wishlist click of the option of the product from the bootpopup above
	function removeProductOptionInWishlist(spor_id,key){		
		$.ajax({
			url: '<?php echo e(url('product/remove_spor_in_wishlist')); ?>',
			type: 'POST',
			data: {spor_id: spor_id},
		})
		.done(function(result) {
			result = $.trim(result);
			var message="",title="",type = "";
			if("true".localeCompare(result)===0){
				title = "<b>Wishlist Remove Success :</b>(From Wishlist)<br> ";
				message = "Product option is removed from the wishlist";
				type = "danger";
				removeItemFromWishlist(key);
			}
			else{
				title = "<b>Wishlist Failure : </b>(From Wishlist)<br>";
				message = "Product option Cannot be removed from the wishlist";
				type = "Warning";
			}
			$(document).ready(function() {
				$.notify({
					title : title,
					message : message,
				},
				{				
					type : type,
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},

				});	
			});
		})
		.fail(function(error,textStatus) {
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax :</b><br> "  ,
					message : "Removing option from wishlist. Error occured is "+textStatus,
				},
				{
					type : "danger",
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},

				},

				);
			});
		})
		.always(function(){
			$(document).ready(function() {
				refreshWishlistAndCart();
			});
		});
	}

	function removeItemFromWishlist(key) {
		$("#cart_item_"+key).remove();
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>