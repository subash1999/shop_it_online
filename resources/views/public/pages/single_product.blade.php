@extends('public/layout/public_layout')

@section('center_content')
<div class="single_product">
	<div class="container">
		<div class="row">
			<!-- Images -->
			<div class="col-lg-2 order-lg-1 order-2">
				<ul class="image_list">
					@foreach ($photos as $single_photo)
					<li data-image="{{ asset('storage/uploads/'.$single_photo->photo) }}"><img class="magnify-image" src="{{ asset('storage/uploads/'.$single_photo->photo) }}" alt="" data-magnify-src="{{ asset('storage/uploads/'.$single_photo->photo) }}"></li>
					@endforeach					
				</ul>
			</div>

			<!-- Selected Image -->
			<div class="col-lg-5 order-lg-2 order-1">
				<div  class="image_selected"><img  src="{{ asset('storage/uploads/'.$photos[0]->photo) }}" alt="" ></div>
			</div>

			<!-- Description -->
			<div class="col-lg-5 order-3">
				<div class="product_description">
					<div class="product_category">{{$product_category_location}}</div>
					{{-- sp means seller product --}}
					<div class="product_name">{{$sp->sp_name1}}</div>
					@auth
					<div id="product_rating" class="rateit" data-rateit-mode="font" data-rateit-resetable="false" style="font-size:30px" data-rateit-value="{{$product_rating}}" data-rateit-step="1"></div>

					@endauth					
					<div class="product_text"><p>{{$sp->description}}</p></div>

					<div class="text-muted mt-2">
						Keywords :						

						@if($sp->sp_name2!=null)
						{{$sp->sp_name2}},
						@endif		
						@if($sp->sp_name3!=null)
						{{$sp->sp_name3}},
						@endif	
						@if($sp->sp_name4!=null)
						{{$sp->sp_name4}},
						@endif	
						@if($sp->sp_name5!=null)
						{{$sp->sp_name5}}
						@endif									

					</div>
					<div class="text-muted">
						@if (count($features)>0)
						<table class="table">

							<th>Features : </th>
							<tbody>
								@foreach ($features as $feature)
								<tr>
									<td>{{$feature->feature}}</td>
									<td>{{$feature->value}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@endif

					</div>
					<div class="mt-3 form-control-label">Total Items Available : {{$sp->remaining}}</div>
					<div class="product_price">{{$currency_symbol}} {{$price}}</div>

				</div>

			</div>
		</div>
		@php
		// a variable to check if the option is available in the page
		$is_option_present = false;
		@endphp
		<div class="row" style="margin: 10px;">
			<div class="product_description">
				<div class="order_info d-flex flex-row">
					<form action="#">

						<div class="clearfix" style="z-index: 1000;">					
							<div class="form-group clearfix">
								@if ($option_groups!=null && is_array($option_groups))
								<label class="form-control-label text-muted" style="font-weight: bold">Options : </label>
								<ul class="ml-3">										
									@foreach ($option_groups as $og_key => $option_group)

									<li><label class="form-control-label" style="font-size: large;"><u>{{$option_group["option_g_name"]}} </u></label>
										<hr>
										<div class="row">

											@foreach ($option_group as $key =>$option)


											@if(is_int($key))
											@php
											$is_option_present = true;
											@endphp
											<div class="col-sm-2 mt-sm-2 mb-sm-2" style="max-width: 40%;">
												<ul class="img-thumbnail">
													<li>
														<label>
															{{$option["option_name"]}}
														</label>
													</li>
													<li>
														<label style="font-size: x-small;">Available : {{$option["number_of_items"]-$option["sold"]}}</label>
													</li>
													<li class="mb-sm-4">
														<a href="{{ asset('storage/uploads/'.$option['photo']) }}" class="btn btn-sm btn-outline-info "  data-lightbox="product_options_{{$option_group["option_g_name"]}}" data-title="{{$option_group['option_g_name']}} :: {{$option["option_name"]}}" alt="{{$option["option_name"]}}"  >
															<img src="{{ asset('storage/uploads/'.$option['photo']) }}" id="" alt="" style="height: inherit;width: inherit" class=" img-fluid" data-magnify-src="{{ asset('storage/uploads/'.$option['photo']) }}" >
														</a>
													</li>
													<li class="mt-sm-4" align="middle">	
														@php
														$json_option = json_encode($option);
														@endphp
														<button type="button" class="btn btn-outline-primary " style="font-size: xx-small; cursor: pointer;" onclick="selectOption('{{$json_option}}','{{$option_group['option_g_name']}}')" id="{{$option['spor_id']}}" >
															Select Option
														</button>

													</li>
												</ul>
											</div>
											@endif
											@endforeach
										</div>
										<hr>
									</li>
									@endforeach
								</ul>
								@endif

							</div>	
							{{-- making the quantity visible if the product option is not present   --}}
							@if (!$is_option_present)

							<!-- Product Quantity -->
							<div class="product_quantity clearfix">
								<span>Quantity: </span>
								<input id="quantity_input" type="number" value="1" max="{{$sp->remaining}}" min="1" pattern="[0-9]*" disabled>
								{{-- removing the incerment and decrement button for quantity-input--}}
								<style type="text/css">
								#quantity_input::-webkit-inner-spin-button,
								#quantity_input::-webkit-outer-spin-button{
									-webkit-appearance:none;
								}
								#quantity_input{
									-moz-appearance:textfield;
								}
							</style>	

							<div class="quantity_buttons">
								<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
								<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
							</div>
						</div>

						<!-- Product Color -->
					{{-- 	<ul class="product_color">
							<li>
								<span>Color: </span>
								<div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
								<div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>
								<ul class="color_list">
									<li><div class="color_mark" style="background: #999999;"></div></li>
									<li><div class="color_mark" style="background: #b19c83;"></div></li>
									<li><div class="color_mark" style="background: #000000;"></div></li>
								</ul>
							</li>
						</ul> --}}

					</div>


					@endif

					<div class="button_container align-self-lg-center" >
						<button type="button" class="button cart_button" id="add_to_cart_btn" align="middle">Add to Cart</button>
						@php
						$wishlist_icon_class = "";
						if ($is_in_wishlist) {
							$wishlist_icon_class = "active";
						}
						@endphp
						<div class="product_fav {{$wishlist_icon_class}}" id="product_wishlist_icon" ><i class="fas fa-heart"></i></div>
						




					</div>
				</form>
			</div>
		</div>
		
		
	</div>


</div>
<hr>

<div class=" user_rating m-lg-5 " id="has_user_rating" style="display: none;">
	<span class="h3">User Ratings</span>

	<div id="avg_product_rating_rateit" class="rateit" data-rateit-mode="font" data-rateit-resetable="false" style="font-size:30px" data-rateit-readonly="true"></div>
	<br>
	<p id="avg_product_rating_out_of"></p>
	<hr style="border:3px solid #f1f1f1">

	<div class="row mr-3 ml-3" id="user_ratings_starwise">
		<div class="col-2">
			<div>5 star</div>
		</div>
		<div class="col-5">
			<div class="progress">
				<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
		<div class="col-2">
			<div>150</div>
		</div>
		
	</div>
</div>
<div class="text-muted h4" id="no_user_rating" align="middle" style="display: none;">
	There are no Ratings Available For this Product 
</div>

<hr>
{{-- ajax call for the user ratings --}}
<script type="text/javascript">
	function updateUserRatings() {
		$.ajax({
			url: "{{ url('product/get_user_ratings/') }}/{{$sp->sp_id}}",
			type: 'GET',			
		})
		.done(function(user_ratings) {
			if(user_ratings!=null){
				if(user_ratings["total_number_of_rating"]>0){
					$("#has_user_rating").show();
					$("#no_user_rating").hide();
					$("#avg_product_rating_rateit").rateit('value',user_ratings['average_rating']);
					$("#avg_product_rating_out_of").text(`${user_ratings["average_rating"]} average based on ${user_ratings["total_number_of_rating"]} reviews.`);
					var ratings_progress = "";
					var progress_class = ["danger",'warning',"info",'success','primary'];
					for (var i = 5; i >=1 ; i--) {
						var rating = user_ratings["star_ratings"][i];
						ratings_progress += `
						<div class="col-lg-12 m-1" width="100%">
						<div class="col-6" align="left">
						<div>${i} Stars (Ratings : ${rating["number_of_ratings"]})</div>
						</div>
						<div class="col-10">
						<div class="progress">
						<div class="progress-bar bg-${progress_class[i-1]}" role="progressbar" style="width: ${rating["percentage_of_ratings"]}%" aria-valuenow=" ${rating["percentage_of_ratings"]}" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						</div>
						<div class="col-4">
						<div></div>
						</div></div>`;
					}
					$("#user_ratings_starwise").html(ratings_progress);
				}
				else{
					$("#no_user_rating").show();
					$("#has_user_rating").hide();
				}


			}
		})
		.fail(function() {
			$.notify({
				title : "Contact Website Ajax Error !!<br>",
				message : "Ajax failure while showing user ratings",
			},
			{				
				type : "danger",
				animate : {
					enter : 'animated lightSpeedIn',
					exit : 'animated lightSpeedOut',
				},								

			});	
		})
		.always(function() {

		});
	}
	$(document).ready(function() {
		updateUserRatings();
	});


</script>


</div>

@endsection
{{-- Assets relating to this page --}}
@section('pagewise_assets')

{{-- links for the product --}}
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/product_responsive.css') }}">
{{-- bar ratings api css--}}
<link rel="stylesheet" type="text/css" href="{{ asset('api/rateit/scripts/rateit.css') }}">
{{-- bar ratings js--}}
<script type="text/javascript" src="{{ asset('api/rateit/scripts/jquery.rateit.min.js') }}"></script>
@auth
<script type="text/javascript">
	// $(document).ready(function() {
		$("#product_rating").bind('rated', function (event,value) { 			
			$.ajax({
				url: '{{ url('product/set_sp_rating') }}',
				type: 'POST',
				data: {
					rating: value,
					sp_id : {{$sp->sp_id}},
				}
			})
			.done(function(result) {
				result = $.trim(result);						
				if("not_logined".localeCompare(result)==0){
					bootbox.alert({
						title : "You are not Logined !!",
						message : "You are not logined so you cannot rate the product",
					});
				}
				else if ("false".localeCompare(result)==0){
					bootbox.alert({
						title : "<b>Failed to Store Rating</b> <br>",
						message : "Some kind of logical error caused the failure to store the product rating",
					});
				}
			})
			.fail(function() {
				$.notify({
					title : "Contact Website Ajax Error !!<br>",
					message : "Ajax failure while submitting product rating",
				},
				{				
					type : "danger",
					animate : {
						enter : 'animated lightSpeedIn',
						exit : 'animated lightSpeedOut',
					},								

				});	
			})
			.always(function () {
				console.log('conpletefsdf');
				updateUserRatings();
			});

		});
	// });
</script>

@endauth

{{-- Script for the product --}}
<script src="{{ asset('one_tech/js/product_custom.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {		
		$('.magnify-image').magnify();		
	});	
	lightbox.option({
		// 'disableScrolling' : true,
		'positionFromTop' : 100,
		'resizeDuration' : 500,
	});	
	
</script>
{{-- script for the adding to cart and wishlist when option present and when option is absent--}}
@if ($is_option_present)
{{-- script if the option is present
	add to cart btn and wishlist button gives popup saying that it is please select an option  --}}
	<script type="text/javascript">
		$(document).ready(function() {
			{{-- script for the add to cart button if the option is present --}}
			{{-- this scirpt gives a popup to the user which will tell the user select one of the option --}}
			$("#add_to_cart_btn").click(function (event){
				event.preventDefault();
				bootbox.alert({
					title:'{{title_case("Select Option From Above : Add to Cart")}}',
					message:"Please select one of the option from above<br> You can then add it to cart",
					backdrop:true,

				});
			});
			// script for the wishlist icon if option is present same as for add to cart button
			$("#product_wishlist_icon").click(function (event){
				event.preventDefault();
				bootbox.alert({
					title:'{{title_case("Select Option From Above : Wishlist")}}',
					message:"Please select one of the option from above<br> You can then add it into wishlist",
					backdrop:true,
				});
			// to make sure that if there is active class remove it and again add it because the function in product_custom.js will toggle it back, prefer not to change the product_custom.js for just this problem
			$("#product_wishlist_icon").removeClass('active');
			// $("#product_wishlist_icon").addClass('active');
		});
		});							

	</script>
	@else
	{{-- script for the add to cart and wishlist button if no option is present --}}
	{{-- if no option is present then the add to cart and wishlist button shoudld do their job of adding the item to cart or wishlist --}}
	<script type="text/javascript">
		{{-- for the add to cart --}}
		$("#add_to_cart_btn").click(function(event) {
			event.preventDefault();
			addToCartClick(this,{{$sp->sp_id}});
		});
		function addToCartClick(element,sp_id) {
			var number_of_items = $("#quantity_input").val();
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
					title = "<b>Cart Success :</b><br> ";
					message = number_of_items+" Item of Product is successfully added to cart";
					type = "success";
				}
				else if("false".localeCompare(result)===0){
					title = "<b>Cart Failure : </b><br>";
					message = number_of_items+" Item of Product Cannot be added to the cart";
					type = "danger";
				}
				else{
					title = "<b>Cart Message : </b><br> ";
					message = result;
					type="warning";
				}

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
			})
			.fail(function(error,textStatus) {
				$(document).ready(function() {
					$.notify({
						title : "<b>Contact website Failure in Ajax : </b><br> "  ,
						message : "Adding product to cart. Error occured is "+textStatus,
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
		{{-- for wishlist --}}
		$("#product_wishlist_icon").click(function(event) {
			event.preventDefault();
			productWishlistClick(this,{{$sp->sp_id}});
		});
		function productWishlistClick(element,sp_id){
			/*The task of toogling the class active is done by product_custom.js js code in asset of onetech, we don't have to toogle the class*/
			// if it doesnot contains class active then it need to be active i.e item is to be added in the wishlist is to be added
			if(!element.classList.contains('active')){
				$.ajax({
					url: '{{ url('product/add_sp_in_wishlist') }}',
					type: 'POST',
					data: {sp_id: sp_id},
				})
				.done(function(result) {
					result = $.trim(result);
					var message="",title="",type = "";
					if("true".localeCompare(result)===0){
						title = "<b>Wishlist Success :</b><br> ";
						message = "Product is successfully added to wishlist";
						type = "success";
					}
					else{
						title = "<b>Wishlist Failure : </b><br>";
						message = "Product Cannot be added to the wishlist";
						type = "danger";
					}

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

				})
				.fail(function(error,textStatus) {
					$(document).ready(function() {
						$.notify({
							title : "<b>Contact website Failure in Ajax : </b><br> "  ,
							message : "Adding product to wishlist. Error occured is "+textStatus,
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
			else{
				$.ajax({
					url: '{{ url('product/remove_sp_in_wishlist') }}',
					type: 'POST',
					data: {sp_id: sp_id},
				})
				.done(function(result) {
					result = $.trim(result);
					var message="",title="",type = "";
					if("true".localeCompare(result)===0){
						title = "<b>Wishlist Remove Success :</b><br> ";
						message = "Product is removed from the wishlist";
						type = "danger";
					}
					else{
						title = "<b>Wishlist Failure : </b><br>";
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
							title : "<b>Contact website Failure in Ajax :</b><br> "  ,
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
		}
	</script>
	@endif
	{{-- script for the option --}}
	{{-- show the script if the option is available so that this script is generated ony if option is present in the page --}}
	{{-- this prevent's other from getting your code of website --}}
	@if ($is_option_present)
	<script >
	// popup for select option btn click
	function selectOption(option,option_g_name) {
		option = $.parseJSON(option);
		var wishlist_class = "";		
		$.ajax({
			url: '{{url('product/is_spor_id_in_wishlist')}}',
			type: 'POST',
			dataType: 'json',
			data: {spor_id: option['spor_id']},
		})
		.done(function(result) {
			result = $.trim(result);		
			if("true".localeCompare(result)==0){
				wishlist_class = "active";
			}
			else{
				wishlist_class = "";
			}
			$("#option_wishlist_btn").removeClass('active');
			$("#option_wishlist_btn").addClass(wishlist_class);				
		})
		.fail(function() {
			wishlist_class="d-none";		
			$("#option_wishlist_btn").removeClass('active');
			$("#option_wishlist_btn").addClass(wishlist_class);		
		}).always(function(){
			$(document).ready(function() {
				refreshWishlistAndCart();
			});
		});

		var form_title = "Add Product to Cart : Option Choice";
		var submit_form = `
		<form style="padding: 10px;" id="add_option_to_cart_form">
		<div class="form-group">
		<div class="row m-1">
		<div class="col-lg-11">
		<img src="{{ asset('storage/uploads/') }}/${option['photo']}" class="img-fluid  img-thumbnail  form-control" name="photo">
		<label class="form-control-label m-1" style='font-size:larger;' for="photo">
		${option_g_name} :: <u>${option['option_name']}</u>
		</label>		

		</div>
		</div>
		</div>
		<div style="font-size:x-large;" class="m-2">{{$currency_symbol}} {{$price}}</div>
		<div class="form-group">
		<div class="row m-1">
		<span>Quantity </span><br><span style="font-size:smaller" class="ml-1"> (Available : ${option['number_of_items']-option['sold']})</span>
		<input id="option_quantity_input" type="number" value="1" max="${option['number_of_items']-option['sold']}" min="1" pattern="[0-9]*" class="form-control" style="color:black;">		
		</div>
		</div>		
		<input type="hidden" id="option_g_name" value="${option_g_name}">
		<input type="hidden" id="spor_id" value="${option['spor_id']}">
		<input type="hidden" id="option_name" value="${option_g_name} ::${option['option_name']}">
		<div class="button_container align-self-lg-center" align="right">
		<input type="submit" class="btn btn-info btn-lg" value="Add to Cart" id="add_option_to_cart_btn" align="middle">
		<!-- this is a comment section :  heart shaped for the wishlist -->
		<div class="product_fav ${wishlist_class}" onclick="productOptionWishlistClick(this,${option['spor_id']},'${option_g_name} ::${option['option_name']}')" id="option_wishlist_btn"><i class="fas fa-heart"></i></div>

		</div>
		</form>`;
		bootbox.confirm({
			message: submit_form,
			title: form_title,
			buttons:{
				confirm: {
					label: 'Add to Cart',
					className: 'btn-info d-none',
				},
				cancel: {
					label: 'Cancel',
					className: 'btn-danger d-none',
				},			
			},
			backdrop: true,
			onEscape : true,
			callback :function (result){
				
			}
		});
		var option_name = $("#option_name").val();
		// on submit for the add_option_to_cart_form
		$("#add_option_to_cart_form").submit(function (event){
			event.preventDefault();
			var number_of_items = $('#option_quantity_input').val();
			// ajax call to add the option to the cart
			$.ajax({
				url: '{{ url('product/add_spor_in_cart') }}',
				type: 'POST',
				data: {
					'spor_id': $("input#spor_id").val(),
					'number_of_items' : $('#option_quantity_input').val(),
				},
			})
			.done(function(result) {				
				result = $.trim(result);
				var message="",title="",type = "";
				if("true".localeCompare(result)===0){
					title = "<b>Cart Success :</b><br> ";
					message = number_of_items+" Item of Product Option <u>"+option_name+"</u> is successfully added to cart";
					type = "success";
				}
				else if("false".localeCompare(result)===0){
					title = "<b>Cart Failure : </b><br>";
					message = number_of_items+" of  Product Option <u>"+option_name+"</u> Cannot be added to the cart";
					type = "danger";
				}
				else{
					title = "<b>Cart Message : </b><br> <u>"+option_name+"</u>";
					message = result;
					type="warning";
				}

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
					element : 'div.bootbox',	

				});	
			})
			.fail(function(error,textStatus) {
				$(document).ready(function() {
					$.notify({
						title : "<b>Contact website Failure in Ajax : </b><br> "  ,
						message : "Adding product option  <u>"+option_name+"</u> to cart. Error occured is "+textStatus,
					},
					{
						type : "danger",
						animate : {
							enter : 'animated lightSpeedIn',
							exit : 'animated lightSpeedOut',
						},
						element : 'div.bootbox',	

					},

					);
				});
			}).always(function(){
				$(document).ready(function() {
					refreshWishlistAndCart();
				});
			});
			
		});

	}
	// for the wishlist click of the option of the product from the bootpopup above
	function productOptionWishlistClick(element,spor_id,option_name){
		element.classList.toggle('active');
		if(element.classList.contains('active')){
			$.ajax({
				url: '{{ url('product/add_spor_in_wishlist') }}',
				type: 'POST',
				data: {spor_id: spor_id},
			})
			.done(function(result) {
				result = $.trim(result);
				var message="",title="",type = "";
				if("true".localeCompare(result)===0){
					title = "<b>Wishlist Success :</b><br> ";
					message = `Product option <u>${option_name}</u> is successfully added to wishlist`;
					type = "success";
				}
				else{
					title = "<b>Wishlist Failure : </b><br>";
					message = "Product Option <u>"+option_name+"</u> Cannot be added to the wishlist";
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
						element : 'div.bootbox',
						// showProgressbar : true,
					});	
				});				
			})
			.fail(function(error,textStatus) {
				$(document).ready(function() {
					$.notify({
						title : "<b>Contact website Failure in Ajax : </b><br> "  ,
						message : "Adding product option <u>"+option_name+"</u> to wishlist. Error occured is "+textStatus,
					},
					{
						type : "danger",
						animate : {
							enter : 'animated lightSpeedIn',
							exit : 'animated lightSpeedOut',
						},
						element : 'div.bootbox',
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
		else{
			$.ajax({
				url: '{{ url('product/remove_spor_in_wishlist') }}',
				type: 'POST',
				data: {spor_id: spor_id},
			})
			.done(function(result) {
				result = $.trim(result);
				var message="",title="",type = "";
				if("true".localeCompare(result)===0){
					title = "<b>Wishlist Remove Success :</b><br> ";
					message = "Product option <u>"+option_name+"</u> is removed from the wishlist";
					type = "danger";
				}
				else{
					title = "<b>Wishlist Failure : </b><br>";
					message = "Product option <u>"+option_name+"</u> Cannot be removed from the wishlist";
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
						element : 'div.bootbox',
						// showProgressbar : true,
					});	
				});
			})
			.fail(function(error,textStatus) {
				$(document).ready(function() {
					$.notify({
						title : "<b>Contact website Failure in Ajax :</b><br> "  ,
						message : "Removing option <u>"+option_name+"</u> from wishlist. Error occured is "+textStatus,
					},
					{
						type : "danger",
						animate : {
							enter : 'animated lightSpeedIn',
							exit : 'animated lightSpeedOut',
						},
						element : 'div.bootbox',
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
	}
</script>
@endif

@endsection