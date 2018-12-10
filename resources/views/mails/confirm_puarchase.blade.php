@extends('mails/layouts/layouts')
@section('title')
OrderConfirmation
@endsection
@section('center')
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3" style="background-color: white;">Hello !</h3>
		<h5>
			Dear Cutomer, We have received an order from this email. 
			<br>
			The Receipt is below : 
		</h5>
		<div class="receipt">
			<div class="cart_section">
				<div class="container">
					<div class="row">
						<div class="col-lg-10 offset-lg-1">		
							<div class="row">
								@php
								// changing the bill info into the array
								$bill_info = (array) $bill_info;
								@endphp
								<div class="col-4 m-3">
								
								<div class="card">
									<div class="card-header"><h6 class="text-muted h6">General Information</h6></div>
									<div class="card-body">
										<ul>
										<li>
											Name : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['name'] }}</label>
										</li>
										<li>
											Email : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['email'] }}</label>

										</li>
										<li>
											Phone : <label class="form-control-label" style="text-decoration: underline;">{{ $bill_info['phone'] }}</label>
										</li>
									</ul></div>
								</div>


							</div>	
							<div class="col-4 m-3">
								<div class="card">
									<div class="card-header"><h6 class="text-muted h6">Billing Address</h6></div>
									<div class="card-body">
										<li>
											Address :<label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['bill_address'] }}</label>
										</li>
										<li>
											City : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['bill_city'] }}</label>
										</li>
										<li>
											Country : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['bill_country'] }}</label>
										</li>											
									</div>
								</div>						
							</div>	
							<div class="col-4 m-3">
								<div class="card">
									<div class="card-header"><h6 class="text-muted h6">Shipping Address</h6></div>
									<div class="card-body">
										<li>
											Address : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['ship_address'] }}</label>
										</li>
										<li>
											City : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['ship_city'] }}</label>
										</li>
										<li>
											Country : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill_info['ship_country'] }}</label>
										</li>											
									</div>
								</div>						
							</div>									
						</div>				
						<ul class="cart_list">
							@foreach ($wl_items as $key => $wl_item) 
							<li class="cart_item clearfix" id="cart_item_{{$key}}">
								<div class="cart_item_image"><a href="{{ url('product')}}/{{$wl_item["sp_id"]}}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('storage/uploads/'.$wl_item["photo"]) }}" alt=""></a></div>
								<div class="wl_item_info d-flex flex-md-row flex-column justify-content-between">
									<div class="cart_item_name cart_info_col">
										<div class="cart_item_title">Name</div>
										<div class="cart_item_text"><a href="{{ url('product')}}/{{$wl_item["sp_id"]}}" target="_blank" rel="noopener noreferrer">{{ $wl_item["name"] }}</a>
											<div style="font-size:small">{{ $wl_item['company_name'] }}</div></div>
										</div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Option</div>
											<div class="cart_item_text">{{ $wl_item["option"] }}</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text"> {{ $wl_item["qty"] }}</label></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Unit Price</div>
											<div class="cart_item_text">{{$currency_symbol}} <label id="unit_price_{{$key}}"> {{ $wl_item["unit_price"] }}</label></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Total Price</div>
											<div class="cart_item_text">{{$currency_symbol}} <label id="unit_price_{{$key}}"> {{ $wl_item["total_price"] }}</label></div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Payable Amount</div>
											<div class="cart_item_text">{{$currency_symbol}} <label id="unit_price_{{$key}}"> {{ $wl_item["payable_amount"] }}</label></div>
										</div>
									</div>
								</li>
								<hr>
								@endforeach
							</ul>

							<!-- Order Total -->
							<div class="order_total">
								<div class="order_total_content text-md-right">
									<div class="order_total_title">Order Total:</div>
									<div class="order_total_amount">{{$currency_symbol}} {{ $bill_info['total_price'] }}</div>
									<div class="order_total_title">Payable Amount:</div>
									<div class="order_total_amount">{{$currency_symbol}} {{ $bill_info['payable_amount'] }}</div>

								</div>
							</div>
							<div class="cart_buttons">
								<div>
									<p>If It was You Please Click the button and confirm the your order. <br>
										Otherwise Please Ignore this mail
									</p>
									<a href="{{ $url }}"><button class="button btn-lg btn-primary">Confirm You Order</button></a>
									<p>If You can't click the button copy and paste the link below in url</p>
									<div class="row">
										<div class="col-12 text-truncate">
											<a style="color:blue;" id="link" href="{{ $url }}" id="url">{{ $url }}</a>
										</div>
									</div>


								</div>
							</div>


						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>
<style>
@include('mails/assets/cart_styles_css')
@include('mails/assets/cart_responsive_css')
</style>
@endsection