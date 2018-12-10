@extends('public/layout/public_layout')
@section('center_content')
@php
	// dd($errors);
@endphp
<form action="{{ url('checkout/checkout_info') }}" method="GET">
	@method('GET')
	@csrf
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Checkout <label style="font-size: small;">(Place Your Order)</label></div>
						<div class="cart_title h4">Total Items : <label>{{ $total_items }}</label></div>
						<div class="cart_items">
							<ul class="cart_list">
								@foreach ($cart_items as $key => $cart_item) 
								@isset ($cart_item["sp_id"])
								<input type="hidden" name="items[{{ $key }}][sp_id]" value="{{$cart_item["sp_id"]}}">								
								@endisset
								@isset ($cart_item["qty"])
								<input type="hidden" name="items[{{ $key }}][qty]" value="{{$cart_item["qty"]}}">								
								@endisset
								@if (array_key_exists("spor_id",$cart_item))
								<input type="hidden" name="items[{{ $key }}][spor_id]" value="{{$cart_item["spor_id"]}}">								
								@endif	

								<li class="cart_item clearfix" id="cart_item_{{$key}}">
									<div class="cart_item_image"><a href="{{ url('product')}}/{{$cart_item["sp_id"]}}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('storage/uploads/'.$cart_item["photo"]) }}" alt=""></a></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">					
											<div class="cart_item_text">Name : <a href="{{ url('product')}}/{{$cart_item["sp_id"]}}" target="_blank" rel="noopener noreferrer" class="hover_underline" >{{ $cart_item["name"] }}</a>
												<br>
												@isset($cart_item["seller_company"])
												<a href="javascript:void(0)"  target="_blank" rel="noopener noreferrer" style="font-size: x-small;color:black;" class="hover_underline">{{ $cart_item["seller_company"] }}</a>
												@endisset
												<style>
												.hover_underline:hover{
													text-decoration: underline;
													color : blue;
												}
											</style>
											@if ($cart_item["option"]!='')
											<div class="">Option</div>
											<div class="cart_option_text" >{{ $cart_item["option"] }}</div>
											@endif

										</div>

									</div>										
									<div class="cart_item_quantity cart_info_col">
										<div class="cart_item_text">Quantity : {{ $cart_item['qty'] }}</div>
										<div class="cart_item_text">

											<div class="">Unit Price : 
												{{$cart_item['currency_symbol']}} <label id="unit_price_{{$key}}"> {{ $cart_item["unit_price"] }}</label>
											</div>
										</div>
									</div>
									<div class="cart_item_price cart_info_col">

									</div>
									<div class="cart_item_total cart_info_col">
										<div class="cart_item_title">Total</div>
										<div class="cart_item_text">{{$cart_item['currency_symbol']}} <label id="total_{{$key}}"> {{ $cart_item["total_price"] }}</label></div>
									</div>										
								</div>
							</li>
							<hr>
							@endforeach
						</ul>
					</div>
					<div>

					</div>



				</div>

			</div>
			<div class="col-lg-3 mt-5 ">
				<div class="card text-white bg-info mb-3 mt-5">
					<div class="card-header card-warning h4">Please Confirm Your Order</div>
					<div class="card-body">
						<div class="row m-2">
							<div class="row m-2">Total Items : {{ $total_items }}</div>
							<div class="m-2">Place Order Of Total:
								<label id="grand_total">{{$currency_symbol}}  {{$grand_total}}</label>
							</div>
							
						</div>
						
						@auth
						<hr>
						<div class="row h6">Discount Coupon : </div>
						<div style="font-size : x-small;">(Discount Coupon can only pay  up to 20% of total sales, once used it cannot be again used so use wisely)</div>
						<div style="font-size : x-small;">(If you have any)</div>
						<div class="row"><input class="form-control" id="discount_coupon" name="discount_coupon" type="text" width="100%" {{ old('discount_coupon') }}></div>
						@if ($errors->has('discount_coupon') || $errors->has('discount_coupon_valid'))
						<div class="alert alert-danger mt-2" role="alert">
							
								@if ($errors->first('discount_coupon_valid')!= $errors->first('discount_coupon'))
								<ul>
									<li><strong>{{ $errors->first('discount_coupon_valid') }}</strong></li>
									<li><strong>{{ $errors->first('discount_coupon') }}</strong></li>
								</ul>
								@else
								<ul>
									<li><strong>{{ $errors->first('discount_coupon_valid') }}</strong></li>
									
								</ul>
								@endif
								
						</div>
						@endif					
						@endauth					
						<div class="row">
							<div class="cart_buttons mr-3">NEXT STEP : 
					{{-- <button type="button" class="button cart_button_clear">Add to Cart</button>
					--}}<input type="submit" style="cursor: pointer;" class="btn btn btn-warning" value="Next: Your Information">
				</div>				
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</form>
@endsection
{{-- Assets relating to this page --}}
@section('pagewise_assets')
{{-- cart custom js --}}
<script src="{{ asset('one_tech/js/cart_custom.js') }}"></script>
{{-- cart custom css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/cart_responsive.css') }}">
@if ($errors->has('not_an_array')||$errors->has('sp_not_set'))
<script>
	$(document).ready(function() {
		bootbox.alert({
			title: "Error in the data being passed, Redirecting to cart in 5 seconds",
			message:  "Please go back to cart and again proceed to checkout <br> Error Message : Data is corrupted",
			size : 'large',
		});
		setTimeout(function () {
       window.location.href = "{{ url('cart') }}"; //will redirect to your blog page (an ex: blog.html)
    }, 5000); //will call the function after 2 secs.
	});

</script>
@endif

@endsection