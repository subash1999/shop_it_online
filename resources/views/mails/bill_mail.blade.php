@extends('mails/layouts/layouts')
@section('title')
Bill Mail 
@endsection
@section('center')
<div align="center" >
	<div class="container-fluid ">
		<h3 class="h3" style="background-color: white;">Hello !</h3>
		<h5>
			Dear Cutomer, This is the bill to your order. 
			<br>
			<label class="text-primary" style="font-size: small">Please Donot delete until you receive your order</label>
			<br>
			The Receipt is below : 
		</h5>
		
		<div class="receipt">
			<h6>Bill ID : {{ $bill->bill_id }}</h6>
			<h6>Payment Status : {{ $bill->payment_status }}</h6>
			<h6>Product Status : {{ $bill->product_status }}</h6>
			<h6>Order Given Date Time : <label class="text-primary">{{ $bill->created_at }}</label></h6>
			
			<h6>Bill Generated Date Time : {{ date("Y-m-d H:i:s ") }}</h6>
				<div class="cart_section">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1">		
								<div class="row">
									
									<div class="col-4 m-3">

										<div class="card">
											<div class="card-header"><h6 class="text-muted h6">General Information</h6></div>
											<div class="card-body">
												<ul>
													<li>
														Name : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->name }}</label>
													</li>
													<li>
														Email : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->email?$bill->email:'NA' }}</label>

													</li>
													<li>
														Phone : <label class="form-control-label" style="text-decoration: underline;">{{ $bill->phone1 }}</label>
													</li>
												</ul></div>
											</div>


										</div>	
										<div class="col-4 m-3">
											<div class="card">
												<div class="card-header"><h6 class="text-muted h6">Billing Address</h6></div>
												<div class="card-body">
													<li>
														Address :<label class="form-control-label" style="text-decoration: underline;"> {{ $bill->bill_address }}</label>
													</li>
													<li>
														City : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->bill_city }}</label>
													</li>
													<li>
														Country : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->bill_country }}</label>
													</li>											
												</div>
											</div>						
										</div>	
										<div class="col-4 m-3">
											<div class="card">
												<div class="card-header"><h6 class="text-muted h6">Shipping Address</h6></div>
												<div class="card-body">
													<li>
														Address : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->ship_address }}</label>
													</li>
													<li>
														City : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->ship_city }}</label>
													</li>
													<li>
														Country : <label class="form-control-label" style="text-decoration: underline;"> {{ $bill->ship_country }}</label>
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
												<div class="order_total_amount">{{$currency_symbol}} {{ $bill->total_amount }}</div>
												<div class="order_total_title">Payable Amount:</div>
												<div class="order_total_amount">{{$currency_symbol}} {{ $bill->final_amount }}</div>

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