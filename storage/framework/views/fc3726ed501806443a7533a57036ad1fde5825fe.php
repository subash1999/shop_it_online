<?php $__env->startSection('center_content'); ?>
<form action="<?php echo e(url('checkout')); ?>" method="GET">
	<?php echo method_field('GET'); ?>
	<?php echo csrf_field(); ?>
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-11 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_title h4">Total Items : <label class="total_cart_items"><?php echo e($total_items); ?></label></div>
						<div class="cart_items">
							<ul class="cart_list">
								<?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
								<?php if(isset($cart_item["sp_id"])): ?>
								<input type="hidden" name="items[<?php echo e($key); ?>][sp_id]" value="<?php echo e($cart_item["sp_id"]); ?>">
								<?php endif; ?>
								<?php if(array_key_exists("spor_id",$cart_item)): ?>
								<input type="hidden" name="items[<?php echo e($key); ?>][spor_id]" value="<?php echo e($cart_item["spor_id"]); ?>">								
								<?php endif; ?>

								<li class="cart_item clearfix" id="cart_item_<?php echo e($key); ?>">
									<div class="cart_item_image"><a href="<?php echo e(url('product')); ?>/<?php echo e($cart_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo e(asset('storage/uploads/'.$cart_item["photo"])); ?>" alt=""></a></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text"><a href="<?php echo e(url('product')); ?>/<?php echo e($cart_item["sp_id"]); ?>" target="_blank" rel="noopener noreferrer" class="hover_underline"><?php echo e($cart_item["name"]); ?></a>
												<br>
												<a href="<?php echo e(url('all_products?seller_id=')); ?><?php echo e($cart_item['seller_id']); ?>"  target="_blank" rel="noopener noreferrer" style="font-size: x-small;color:black;" class="hover_underline"><?php echo e($cart_item["seller_company"]); ?></a>
												<style>
												.hover_underline:hover{
													text-decoration: underline;
													color : blue;								
												}
											</style>
										</div>
									</div>
									<div class="cart_item_color cart_info_col">
										<div class="cart_item_title">Option</div>
										<div class="cart_item_text cart_option_text" ><?php echo e($cart_item["option"] ? $cart_item["option"]:'NA (Not Available)'); ?></div>				
									</div>
									<div class="cart_item_quantity form-inline cart_info_col ">
										<div class="cart_item_title">Quantity</div>
										<div class="cart_item_text">
											<div id="qty_<?php echo e($key); ?>"></div>
											
											<script type="text/javascript">
												var prev_val_<?php echo e($key); ?> = <?php echo e($cart_item["qty"]); ?>;
												var next_val_<?php echo e($key); ?> = null;
												var input = null;
												$(document).ready(function(){
													dpUI.numberPicker("#qty_<?php echo e($key); ?>", {
														start : <?php echo e($cart_item["qty"]); ?>,
														min: 1,
														max: <?php echo e($cart_item["max"]); ?>,
														step: 1,						
														// call back functions 
														onReady : function(x){
															$(x).children().filter("input").attr('disabled',true);
														},
														beforeChange: function(x){
															prev_val_<?php echo e($key); ?> = $(x).children().filter("input").val();
															$(x).children().filter("input").attr('disabled',true);
															input = $(x).children().filter("input");
														},
														afterChange: function (x) {
															input = $(x).children().filter("input");
															$(x).children().filter("input").attr('disabled',true);
															next_val_<?php echo e($key); ?> = $(x).children().filter("input").val();
															next_val_<?php echo e($key); ?> = parseInt(next_val_<?php echo e($key); ?>,10);
															if(!Number.isInteger(next_val_<?php echo e($key); ?>) ||  (next_val_<?php echo e($key); ?> - Math.floor(next_val_<?php echo e($key); ?>)) !== 0 ){
																$(document).ready(function() {
																	$.notify({
																		title : "<b>Please Enter a valid number in quantity field</b><br> "  ,
																		message : "Only valid Integer is accepted as quantity",
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
																return 0;
															}
															if(prev_val_<?php echo e($key); ?>!=next_val_<?php echo e($key); ?>){
																updateCart(<?php echo e($cart_item['sp_id']); ?>,"<?php echo e($cart_item['spor_id']); ?>",next_val_<?php echo e($key); ?>,<?php echo e($key); ?>,prev_val_<?php echo e($key); ?>,input);
																
															}
															
														}

													});
												});
											</script>
										</div>
									</div>
									<div class="cart_item_price cart_info_col">
										<div class="cart_item_title">Unit Price</div>
										<div class="cart_item_text"><?php echo e($cart_item['currency_symbol']); ?> <label id="unit_price_<?php echo e($key); ?>"> <?php echo e($cart_item["unit_price"]); ?></label></div>
									</div>
									<div class="cart_item_total cart_info_col">
										<div class="cart_item_title">Total</div>
										<div class="cart_item_text"><?php echo e($cart_item['currency_symbol']); ?> <label id="total_<?php echo e($key); ?>"> <?php echo e($cart_item["total_price"]); ?></label></div>
									</div>
									<div class="cart_item_total cart_info_col">
										<div class="cart_item_title">Action</div>
										<div style="margin-top: 35px;font-size: 24px;"><div class="wishlist_icon" id="wishlist_icon_<?php echo e($key); ?>" title="Move to Wishlist"><i class="fas fa-heart" onclick="moveProductToWishlist(<?php echo e($cart_item['sp_id']); ?>,'<?php echo e($cart_item['spor_id']); ?>',<?php echo e($key); ?>)"></i></div>&nbsp;&nbsp;&nbsp;
										
										<i id="delete_btn_<?php echo e($key); ?>" class="far fa-trash-alt" title="Delete" style="cursor: pointer;color:red;" aria-hidden="true" onclick="deleteCartItem(<?php echo e($cart_item['sp_id']); ?>,'<?php echo e($cart_item['spor_id']); ?>',0,<?php echo e($key); ?>)"></i>											
									</div>
								</div>
							</div>
						</li>
						<hr>
						
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
				<div>
										
					</div>
					<!-- Order Total -->
					<div class="order_total">
						<div class="order_total_content text-md-right">
							<div class="order_total_title">Order Total:</div>
							<div class="order_total_amount"><?php echo e($currency_symbol); ?> <label id="grand_total"><?php echo e($grand_total); ?></label></div>
						</div>
					</div>

					<div class="cart_buttons mr-3">
						<?php if($total_items>0): ?>
						<input type="submit" class="button cart_button_checkout" value="Proceed to Checkout">
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagewise_assets'); ?>

<script src="<?php echo e(asset('one_tech/js/cart_custom.js')); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_styles.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('one_tech/styles/cart_responsive.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('api/number_picker/src/dpNumberPicker-2.x-skin.grey.css')); ?>">
<script src="<?php echo e(asset('api/number_picker/src/dpNumberPicker-2.x.js')); ?>"></script>
<script type="text/javascript">
	function updateCart(sp_id,spor_id,qty,key,prev_qty=null,input=null) {
		if(spor_id==""){
			spor_id = null;
		}		
		$.ajax({
			url: '<?php echo e(url('cart/update_product_qty_in_cart')); ?>',
			type: 'PUT',
			data: {sp_id: sp_id ,
				spor_id : spor_id,
				qty : qty,		

			}
		})
		.done(function(result) {
			result = $.trim(result);		
			if("true".localeCompare(result)==0){
				if(qty==0){
					$("#cart_item_"+key).remove();
					$(document).ready(function() {
						$.notify({
							title : "<b>Item Removed From Cart</b><br>",
							message : "Selected Item was removed successfully form the cart",
						},
						{				
							type : "danger",
							animate : {
								enter : 'animated lightSpeedIn',
								exit : 'animated lightSpeedOut',
							},
						});	
					});			
				}
			}
			else if ("false".localeCompare(result)==0){
				if(input!=null){
					input.val(prev_qty);
				}
			}
			else{
				bootbox.alert({
					title : "Server Message",
					message:result,
					backdrop:true,

				});
			}



		})
		.fail(function(jqxhr,textStatus,err) {
			if(input!=null){
				input.val(prev_qty);
			}
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax : </b><br> "  ,
					message : "Updating Cart(Qunatity)  Error . Error occured is "+err,
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
		.always(function() {
			refreshWishlistAndCart();
			updateProductValues(sp_id,spor_id,key);
			updateGrandTotal();
		});
	}
	function updateProductValues(sp_id,spor_id,key) {
		$.ajax({
			url: '<?php echo e(url('cart/single_product_cart_values')); ?>',
			type: 'GET',
			data: {sp_id: sp_id,
				spor_id : spor_id,
			},
		})
		.done(function(cart) {
			var unit_price = $('#unit_price_'+key);
			var total_price = $('#total_'+key);
			unit_price.text(cart['unit_price']);
			total_price.text(cart['total_price']);
		})
		.fail(function(jqxhr,textStatus,err) {
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax : </b><br> "  ,
					message : "Updating total prices values after quantity change  Error . Error occured is "+err+"<br>Refresh the page to see the changes",
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
		.always(function() {
			updateGrandTotal();
		});

	}
	function updateGrandTotal() {
		$.ajax({
			url: '<?php echo e(url('cart/total_price_of_cart')); ?>',
			type: 'GET',
		})
		.done(function(result) {
			result = $.trim(result);
			$('#grand_total').text(result);

		})
		.fail(function(jqxhr,textStatus,err) {
			$(document).ready(function() {
				$.notify({
					title : "<b>Contact website Failure in Ajax : </b><br> "  ,
					message : "Updating Grand total of cart after quantity change  Error . Error occured is "+err+"<br>Refresh the page to see the changes",
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


	}
	function moveProductToWishlist(sp_id,spor_id,key) {
		bootbox.confirm({
			title: "Item(s) will be moved to the wishlist",
			message : "The items will be deleted from the cart and moved to the wishlist",
			buttons:{
				confirm: {
					label: 'Move to Wishlist',
					className: 'btn-info',
				},
				cancel: {
					label: 'Cancel',
					className: 'btn-danger',
				},			
			},
			backdrop: true,
			onEscape : true,
			callback :function (result){
				if(result==true){
					//qty must be given as zero to remove the product
					var qty = 0;
					// while adding to wishlist the items in the cart is also deleted so the qty is passed 0
					addToWishlist(sp_id,spor_id,qty,key);
					
					
				}
			}
		});
	}
	function addToWishlist(sp_id,spor_id,qty,key) {
		var ret = false;
		var url = "<?php echo e(url('product/add_sp_in_wishlist')); ?>";
		if(spor_id==""){
			spor_id = null;

		}
		else {
			url = "<?php echo e(url('product/add_spor_in_wishlist')); ?>";
		}
		$.ajax({
			url: url,
			type: 'POST',
			data: {sp_id: sp_id,
				spor_id:spor_id},
			})
		.done(function(result) {
			result = $.trim(result);
			var message="",title="",type = "";
			if("true".localeCompare(result)===0){
				title = "<b>Wishlist Success :</b><br> ";
				message = `Product is successfully added to wishlist`;
				type = "success";
				ret = true;
			}
			else{
				title = "<b>Wishlist Failure : </b><br>";
				message = "Product cannot be added to the wishlist";
				type = "danger";
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
					message : "Adding product to wishlist from cart. Error occured is "+textStatus,
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
				if(ret){
					updateCart(sp_id,spor_id,qty,key);
				}
			});
		});

	}
	function deleteCartItem(sp_id,spor_id,qty=0,key) {
		bootbox.confirm({
			title: "Item(s) will be deleted from cart",
			message : "Are you sure? If you want to save it for later add it to wishlist.",
			buttons:{
				confirm: {
					label: 'Delete From Cart',
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
					//qty must be given as zero to remove the product				
					updateCart(sp_id,spor_id,qty,key);
				}
			}
		});

	}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('public/layout/public_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>