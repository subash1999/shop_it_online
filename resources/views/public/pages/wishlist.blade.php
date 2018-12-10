@extends('public/layout/public_layout')
@section('center_content')

<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="cart_container">
					<div class="cart_title">Wishlist</div>
					<div class="cart_title h4">Total Products : <label class="total_wishlist_items">{{count($wl_items)}}</label></div>
					<div class="cart_items">
						<ul class="cart_list">
							@foreach ($wl_items as $key => $wl_item) 
							<li class="cart_item clearfix" id="cart_item_{{$key}}">
								<div class="cart_item_image"><a href="{{ url('product')}}/{{$wl_item["sp_id"]}}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('storage/uploads/'.$wl_item["photo"]) }}" alt=""></a></div>
								<div class="wl_item_info d-flex flex-md-row flex-column justify-content-between">
									<div class="cart_item_name cart_info_col">
										<div class="cart_item_title">Name</div>
										<div class="cart_item_text"><a href="{{ url('product')}}/{{$wl_item["sp_id"]}}" target="_blank" rel="noopener noreferrer">{{ $wl_item["name"] }}</a></div>
									</div>
									<div class="cart_item_color cart_info_col">
										<div class="cart_item_title">Option</div>
										<div class="cart_item_text">{{ $wl_item["option"] }}</div>
									</div>
									<div class="cart_item_price cart_info_col">
										<div class="cart_item_title">Unit Price</div>
										<div class="cart_item_text">{{$wl_item['currency_symbol']}} <label id="unit_price_{{$key}}"> {{ $wl_item["unit_price"] }}</label></div>
									</div>
									<div class="cart_item_total cart_info_col">
										<div class="cart_item_title">Action</div>
										<div style="margin-top: 35px;font-size: 24px;">
											<i class="fa fa-shopping-basket"
											onclick="addToCart({{$wl_item['sp_id']}},'{{$wl_item['spor_id']}}',{{$key}})" style="cursor: pointer;color:#28a745"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											{{--0 is passed for quantity so while updating wishlist the controller will delete that, mechanism is in wishlisthelper  --}}
											<i id="delete_btn_{{$key}}" class="far fa-trash-alt" title="Delete" style="cursor: pointer;color:red;" aria-hidden="true" onclick="deleteWishlistItem({{$wl_item['sp_id']}},'{{$wl_item['spor_id']}}',{{$key}})"></i>											
										</div>
									</div>
								</div>
							</li>
							<hr>
							@endforeach
						</ul>
					</div>
					<div>
						{{ $wl_items->links() }}
					</div>
				
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
{{-- Assets relating to this page --}}
@section('pagewise_assets')
{{-- cart custom js --}}
<script src="{{ asset('one_tech/js/cart_custom.js') }}"></script>
{{-- cart custom css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/cart_responsive.css') }}">
{{-- add to cart function --}}
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
{{-- functions to call form the above functions --}}
<script type="text/javascript">
	function addSellerProductToCartClick(sp_id,number_of_items) {
		if(number_of_items<=0){
			number_of_items=1;
		}
		$.ajax({
			url: '{{ url('product/add_sp_in_cart') }}',
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
			url: '{{ url('product/add_spor_in_cart') }}',
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
			url: '{{ url('product/remove_sp_in_wishlist') }}',
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
			url: '{{ url('product/remove_spor_in_wishlist') }}',
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
@endsection